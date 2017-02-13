<?php

namespace Fourxxi\NotificationSender;

class CurlException extends \Exception
{
    /**
     * SlackNotificationRequestException constructor.
     * @param string $error
     */
    public function __construct($error)
    {
        parent::__construct('Error in curl request: '.$error);
    }
}