<?php

declare(strict_types=1);

namespace Comics\Service;

class NotificationService
{
    public function send(string $url, string $name, array $payload = []): void
    {
        $lockFileService = new LockFileService($url, $name, $payload);
        if (!$lockFileService->isLocked()) {
            $httpClientService = new HttpClientService();
            $headers = [
                'Content-Type: application/json',
                'Content-Length: '.strlen(json_encode($payload, JSON_UNESCAPED_SLASHES)),
            ];
            $httpClientService->post($url, ['json' => $payload, 'headers' => $headers]);
            $lockFileService->writeLockFile();
        }
    }
}
