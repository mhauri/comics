<?php

declare(strict_types=1);

namespace Comics\Client;

use Comics\NotificationClientInterface;
use Comics\Service\NotificationService;

class Teams implements NotificationClientInterface
{
    public function notify(string $name, string $image)
    {
        if ($name && $image) {
            $payload = [
                'text' => sprintf(
                    '<strong>%s</strong> <br/><img src="%s"/>',
                    $name,
                    $image
                ),
            ];
            $notificationService = new NotificationService();
            $notificationService->send(getenv('TEAMS_WEBHOOK_URL'), $name, $payload);
        }
    }
}
