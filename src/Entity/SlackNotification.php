<?php

namespace Entity;

class SlackNotification implements NotificationInterface
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    /** @var string Actually required field */
    private $fallback = '';

    /** @var string */
    private $color = self::COLOR_GOOD;

    /** @var string|null */
    private $pretext = null;

    /** @var string|null */
    private $text = null;

    /** @var array */
    private $fields = [];

    /**
     * @param Pattern $pattern
     *
     * @return SlackNotification
     */
    public static function createByPattern(Pattern $pattern)
    {
        $text = sprintf(
            '%s [%s] | <%s|Читать>',
            $pattern->getTitle(),
            $pattern->getType(),
            $pattern->getLink()
        );

        $notification = new self();
        $notification->setFallback($text);
        $notification->setPretext($text);
        $notification->addField([
            'title' => null,
            'value' => $pattern->getShortDescription(),
            'short' => false,
        ]);

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
            'text' => $this->getText(),
            'pretext' => $this->getPretext(),
            'fields' => $this->getFields(),
        ];
    }

    /**
     * @return string
     */
    public function getFallback(): string
    {
        return $this->fallback;
    }

    /**
     * @param string $fallback
     */
    public function setFallback(string $fallback)
    {
        $this->fallback = $fallback;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getPretext()
    {
        return $this->pretext;
    }

    /**
     * @param string $pretext
     */
    public function setPretext(string $pretext)
    {
        $this->pretext = $pretext;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
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
}
