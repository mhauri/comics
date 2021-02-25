<?php

declare(strict_types=1);

namespace Comics\Command;

use Comics\ComicInterface;
use Comics\Exception\ClassNotFoundException;
use Comics\Exception\WebhookUrlNotSetException;
use Comics\NotificationClientInterface;
use Robo\Tasks;

class ComicCommand extends Tasks
{
    public function sendComic(string $name)
    {
        $class = $this->getComicClassByName($name);
        $clients = $this->getClients();

        if ($class && $clients) {
            /**
             * @var ComicInterface
             */
            $comic = new $class();

            foreach ($clients as $client) {
                /*
                 * @var NotificationClientInterface
                 */
                $client->notify($comic->getName(), $comic->getImage());
            }
        }
    }

    private function getComicClassByName(string $name): string
    {
        return $this->getClassByName($name, '\\Comics\\Comic');
    }

    private function getClientClassByName(string $name): string
    {
        return $this->getClassByName($name, '\\Comics\\Client');
    }

    private function getClassByName(string $name, string $namespace): string
    {
        $class = sprintf('%s\\%s', $namespace, ucfirst($name));
        if (class_exists($class)) {
            return $class;
        }

        throw new ClassNotFoundException($name);
    }

    private function getClients(): array
    {
        $notificationClients = [];
        $clients = getenv('CLIENTS');

        if ($clients) {
            $clients = explode(',', $clients);
            foreach ($clients as $client) {
                try {
                    $this->validateClientWebHookUrl($client);
                    $class = $this->getClientClassByName($client);
                    $notificationClients[] = new $class();
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        return $notificationClients;
    }

    private function validateClientWebHookUrl(string $client)
    {
        if (!(bool) getenv(sprintf('%s_WEBHOOK_URL', strtoupper($client)))) {
            throw new WebhookUrlNotSetException($client);
        }
    }
}
