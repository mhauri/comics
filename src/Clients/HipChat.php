<?php
declare (strict_types=1);

namespace Comics\Clients;

class HipChat extends AbstractClient
{
    public function send() : bool
    {
        $name = $this->getComicName();
        $image = $this->getComicImage();

        if($name && $image) {
            $payload = [

            ];

            return $this->_send(getenv('HIPCHAT_WEBHOOK_URL'), $payload);
        }
        return false;
    }
}
