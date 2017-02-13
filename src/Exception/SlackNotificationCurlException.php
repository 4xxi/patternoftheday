<?php

namespace Fourxxi\NotificationSender;

class SlackNotificationCurlException extends CurlException
{
    /**
     * SlackNotificationRequestException constructor.
     * @param string $error
     */
    public function __construct($error)
    {
        parent::__construct($error);
    }
}