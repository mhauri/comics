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
                'icon_emoji' => getenv('SLACK_ICON') ?? ':smile:',
                'attachments' => [[
                    'fallback' => $name,
                    "image_url" => $image,
                ]],
            ];

            return $this->_send(getenv('SLACK_WEBHOOK_URL'), $payload);
        }
        return false;
    }
}
