<?php

namespace Entity;

class SlackNotification implements NotificationInterface
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    /** @var string Actually required field */
    private $fallback = '';

    /** @var string|null */
    private $title;

    /** @var string|null */
    private $titleLink;

    /** @var string|null */
    private $imageUrl;

    /** @var string|null */
    private $authorName;

    /** @var string|null */
    private $authorLink;

    /** @var string */
    private $color = self::COLOR_GOOD;

    /** @var string|null */
    private $pretext;

    /** @var string|null */
    private $text;

    /** @var array */
    private $fields = [];

    /**
     * @param Pattern $pattern
     *
     * @return SlackNotification
     */
    public static function createByPattern(Pattern $pattern)
    {
        $text = $pattern->getTitle();
        if ($pattern->getType()) {
            $text .= ' ['.$pattern->getType().']';
        }

        $notification = new self();
        $notification->setFallback($text);
        $notification->setTitle($text);
        $notification->setTitleLink($pattern->getLink());
        $notification->setText($pattern->getShortDescription());
        $notification->setImageUrl($pattern->getImageUrl());
        $notification->setAuthorName($pattern->getAuthorName());
        $notification->setAuthorLink($pattern->getAuthorLink());

        return $notification;
    }

    /**
     * @return array
     */
    public function asAttachment()
    {
        return [
            'fallback' => $this->getFallback(),
            'color' => $this->getColor(),
            'title' => $this->getTitle(),
            'title_link' => $this->getTitleLink(),
            'image_url' => $this->getImageUrl(),
            'text' => $this->getText(),
            'pretext' => '<!channel>',
            'fields' => $this->getFields(),
            'author_name' => $this->getAuthorName(),
            'author_link' => $this->getAuthorLink(),
        ];
    }

    /**
     * @return string
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * @param string $fallback
     */
    public function setFallback($fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return string|null|null
     */
    public function getPretext()
    {
        return $this->pretext;
    }

    /**
     * @param string|null $pretext
     */
    public function setPretext($pretext)
    {
        $this->pretext = $pretext;
    }

    /**
     * @return string|null|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $field
     *
     * @return array
     */
    public function addField(array $field)
    {
        return $this->fields[] = $field;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getTitleLink()
    {
        return $this->titleLink;
    }

    /**
     * @param string|null $titleLink
     */
    public function setTitleLink($titleLink)
    {
        $this->titleLink = $titleLink;
    }

    /**
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string|null
     */
    public function getAuthorLink()
    {
        return $this->authorLink;
    }

    /**
     * @param string|null $authorLink
     */
    public function setAuthorLink($authorLink)
    {
        $this->authorLink = $authorLink;
    }
}
