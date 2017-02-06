<?php

namespace Command;

use Entity\Notification\SlackNotificationPatternAdapter;
use Entity\Pattern;
use Entity\PatternCollection;
use NotificationSender\SlackNotificationSender;
use Parser\SenderFactory;
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
        /** @var PatternCollection $catalogue */
        $catalogue = SenderFactory::create(SenderFactory::SENDER_REFACTORING_GURU_JSON)->getItems();

        $pattern = $this->getPatternOfTheDay($catalogue);

        $notification = new SlackNotificationPatternAdapter($pattern);

        $sender = new SlackNotificationSender(getenv('slack_channel'), getenv('slack_hook_url'));
        $result = $sender->send($notification);

        if ($result !== true) {
            $output->writeln('Error: '.$result);
        }
    }

    /**
     * @param PatternCollection $collection
     *
     * @return Pattern
     */
    private function getPatternOfTheDay(PatternCollection $collection) : Pattern
    {
        $dayOfTheYear = (new \DateTime())->format('z');

        return $collection[$dayOfTheYear % count($collection)];
    }
}
