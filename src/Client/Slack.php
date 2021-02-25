<?php

declare(strict_types=1);

namespace Comics\Client;

use Comics\NotificationClientInterface;
use Comics\Service\NotificationService;

class Slack implements NotificationClientInterface
{
    public function notify(string $name, string $image)
    {
        $channel = getenv('SLACK_CHANNEL');
        if ($name && $image && $channel) {
            $icon = sprintf(':%s:', strtolower($name));
            if ((bool) getenv('SLACK_ICON')) {
                $icon = getenv('SLACK_ICON');
            }

            $payload = [
                'username' => $name,
                'icon_emoji' => $icon,
                'attachments' => [
                    [
                        'fallback' => $name,
                        'image_url' => $image,
                    ],
                ],
            ];

            $notificationService = new NotificationService();
            $notificationService->send(getenv('SLACK_WEBHOOK_URL'), $name, $payload);
        }
    }
}
