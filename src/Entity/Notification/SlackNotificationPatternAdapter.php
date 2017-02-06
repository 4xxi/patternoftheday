<?php

namespace Entity\Notification;

use Entity\Pattern;

class SlackNotificationPatternAdapter implements SlackNotificationInterface
{
    /** @var Pattern */
    private $pattern;

    public function __construct(Pattern $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return string
     */
    public function getFallback()
    {
        $text = $this->pattern->getTitle();
        if ($this->pattern->getType()) {
            $text .= ' ['.$this->pattern->getType().']';
        }

        return $text;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return SlackNotificationInterface::COLOR_GOOD;
    }

    /**
     * @return string|null
     */
    public function getPretext()
    {
        return SlackNotificationInterface::LEVEL_CHANNEL;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getFallback();
    }

    /**
     * @return string|null
     */
    public function getTitleLink()
    {
        return $this->pattern->getLink();
    }

    /**
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->pattern->getImageUrl();
    }

    /**
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->pattern->getAuthorName();
    }

    /**
     * @return string|null
     */
    public function getAuthorLink()
    {
        return $this->pattern->getAuthorLink();
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->pattern->getShortDescription();
    }
}
