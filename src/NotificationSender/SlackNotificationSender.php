<?php

namespace Fourxxi\NotificationSender;

use Fourxxi\Entity\Notification\SlackNotificationInterface;

class SlackNotificationSender
{
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
     * @param SlackNotificationInterface $notification
     *
     * @return bool|string Returns true or error message string
     */
    public function send(SlackNotificationInterface $notification): bool
    {
        $url = $this->hookUrl;
        $data = [
            'channel' => $this->channel,
            'attachments' => [$this->buildAttachmentByNotification($notification)],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $error ?: true;
    }

    /**
     * @param SlackNotificationInterface $notification
     *
     * @return array
     */
    private function buildAttachmentByNotification(SlackNotificationInterface $notification)
    {
        return [
            'pretext' => $notification->getPretext(),
            'fallback' => $notification->getFallback(),
            'color' => $notification->getColor(),
            'title' => $notification->getTitle(),
            'title_link' => $notification->getTitleLink(),
            'image_url' => $notification->getImageUrl(),
            'text' => $notification->getText(),
            'author_name' => $notification->getAuthorName(),
            'author_link' => $notification->getAuthorLink(),
        ];
    }
}
