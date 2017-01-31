<?php

namespace Command;

use Entity\Collection;
use Entity\Pattern;
use Entity\SlackNotification;
use NotificationSender\SlackNotificationSender;
use Parser\CppReferenceRuWebsiteParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PatternOfTheDayCommand extends Command
{
    protected function configure()
    {
        $this->setName('4xxi:patternoftheday');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $allPatterns = (new CppReferenceRuWebsiteParser())->getItems();

        $pattern = $this->getPatternOfTheDay($allPatterns);

        $message = SlackNotification::createByPattern($pattern);

        $sender = new SlackNotificationSender(getenv('slack_channel'), getenv('slack_hook_url'));
        $sender->send($message);
    }

    /**
     * @param Collection $collection
     *
     * @return Pattern
     */
    private function getPatternOfTheDay(Collection $collection) : Pattern
    {
        $dayOfTheYear = (new \DateTime())->format('z');

        return $collection[$dayOfTheYear % count($collection)];
    }
}
