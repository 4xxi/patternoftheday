<?php

namespace Tests\Entity\Notification;

use Fourxxi\Entity\Notification\SlackNotificationInterface;
use Fourxxi\Entity\Notification\SlackNotificationPatternAdapter;
use Fourxxi\Entity\Pattern;
use PHPUnit\Framework\TestCase;

class SlackNotificationPatternAdapterTest extends TestCase
{
    public function testColorAndPretextValues()
    {
        // Create a patternMock for the SomeClass class.
        $patternMock = $this->createMock(Pattern::class);

        $target = new SlackNotificationPatternAdapter($patternMock);

        self::assertEquals(SlackNotificationInterface::COLOR_GOOD, $target->getColor());
        self::assertEquals(SlackNotificationInterface::LEVEL_CHANNEL, $target->getPretext());
    }

    public function testGetFallbackAndGetTitle()
    {
        // Create a patternMock for the SomeClass class.
        $patternMock = $this->createMock(Pattern::class);

        $patternMock->method('getTitle')->willReturn('Pattern Title');
        $target = new SlackNotificationPatternAdapter($patternMock);

        self::assertEquals('Pattern Title', $target->getFallback());
        self::assertEquals($target->getFallback(), $target->getTitle());

        $patternMock->method('getType')->willReturn('Type');
        self::assertEquals('Pattern Title [Type]', $target->getFallback());
        self::assertEquals($target->getFallback(), $target->getTitle());
    }
}
