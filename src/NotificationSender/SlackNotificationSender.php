<?php

namespace NotificationSender;

use Entity\SlackNotification;

class SlackNotificationSender implements NotificationSenderInterface
{
    const MESSAGE_COLOR = 'good';

    /** @var string */
    private $channel = null;

    /** @var string */
    private $hookUrl = null;

    /**
     * @param string $channel Name of a Slack channel
     * @param string $hookUrl Slack integration url (from admin panel)
     */
    public function __construct(string $channel, string $hookUrl)
    {
        $this->channel = $channel;
        $this->hookUrl = $hookUrl;
    }

    /**
     * @param SlackNotification $notification
     *
     * @return bool
     */
    public function send($notification): bool
    {
        $url = $this->hookUrl;
        $data = [
            'channel' => $this->channel,
            'attachments' => [$notification->asAttachment()],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
        curl_exec($ch);
        curl_close($ch);

        return true;
    }
}
