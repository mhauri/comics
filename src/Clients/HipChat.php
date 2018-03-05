<?php
declare(strict_types=1);

namespace Comics\Clients;

class HipChat extends AbstractClient
{
    public function send() : bool
    {
        $name = $this->getComicName();
        $image = $this->getComicImage();

        if ($name && $image) {
            $message = sprintf('%s<br /><a href="%s"><img src="%s"/></a>', $name, $image, $image);
            $payload = [
                'message'=> $message,
                'message_format' => 'html',
                'color' => getenv('HIPCHAT_COLOR') ?? 'yellow',
                'notify' => getenv('HIPCHAT_NOTIFY') ?? 'yellow',
            ];

            return $this->_send(getenv('HIPCHAT_WEBHOOK_URL'), $payload);
        }
        return false;
    }
}
