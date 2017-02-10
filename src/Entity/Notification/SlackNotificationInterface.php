<?php

namespace Fourxxi\Entity\Notification;

interface SlackNotificationInterface
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    const LEVEL_CHANNEL = '<!channel>';

    /**
     * @return string
     */
    public function getFallback();

    /**
     * @return string|null
     */
    public function getColor();

    /**
     * @return string|null
     */
    public function getPretext();

    /**
     * @return string|null
     */
    public function getText();

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getTitleLink();

    /**
     * @return string|null
     */
    public function getImageUrl();

    /**
     * @return string|null
     */
    public function getAuthorName();

    /**
     * @return string|null
     */
    public function getAuthorLink();
}
