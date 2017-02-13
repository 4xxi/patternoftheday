<?php

namespace Fourxxi\Command;

use Fourxxi\Entity\Notification\SlackNotificationPatternAdapter;
use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Exception\ParsingException;
use Fourxxi\NotificationSender\SlackNotificationSender;
use Fourxxi\Parser\AbstractParser\PatternParserInterface;
use Fourxxi\Parser\ParserFactory;
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
     *
     * @throws ParsingException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var PatternParserInterface */
        $parser = ParserFactory::create(ParserFactory::PARSER_REFACTORING_GURU_JSON);

        try {
            /** @var PatternCollection $catalogue */
            $catalogue = $parser->getItems();
        } catch (\Throwable $exception) {
            throw new ParsingException('Error during parsing of catalogue: '.$exception->getMessage());
        }

        $pattern = $this->getPatternOfTheDay($catalogue);

        $notification = new SlackNotificationPatternAdapter($pattern);

        $sender = new SlackNotificationSender(getenv('slack_channel'), getenv('slack_hook_url'));
        $sender->send($notification);
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
