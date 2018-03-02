<?php
declare (strict_types=1);

namespace Comics\Clients;

class Slack extends AbstractClient
{
    public function send() : bool
    {
        $name = $this->getComicName();
        $image = $this->getComicImage();
        $channel = getenv('SLACK_CHANNEL');

        if($name && $image && $channel) {
            $payload = [
                'username' => $name,
                'text' => $image,
                'mrkdwn' => 'true',
                'mrkdwn_in' => 'text',
                'icon_emoji' => getenv('SLACK_ICON') ?? ':laughing:'
            ];

            return $this->_send(getenv('SLACK_WEBHOOK_URL'), $payload);
        }
        return false;
    }
}
