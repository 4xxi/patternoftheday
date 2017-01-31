<?php

namespace NotificationSender;

use Entity\NotificationInterface;

interface NotificationSenderInterface
{
    /**
     * Send text and return true if it completes successfully.
     *
     * @param NotificationInterface $notification
     *
     * @return bool
     */
    public function send($notification) : bool;
}
