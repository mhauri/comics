<?php

declare(strict_types=1);

namespace Comics\Commands;

use Robo\Tasks;

class SendComicCommand extends Tasks
{
    /**
     * Send comics to configured channels/rooms.
     */
    public function sendComic(string $name)
    {
        $class = $this->getComicClassByName($name);
        $clients = $this->getClients();

        if ($class && $clients) {
            /**
             * @var \Comics\Comics\ComicsInterface
             */
            $comic = new $class();

            foreach ($clients as $client) {
                /*
                 * @var $client \Comics\Clients\ClientInterface
                 */
                $client
                    ->setComicName($comic->getName())
                    ->setComicImage($comic->getImage())
                    ->send();
            }
        }
    }

    private function getComicClassByName(string $name): string
    {
        return $this->getClassByName($name, '\\Comics\\Comics');
    }

    private function getClientClassByName(string $name): string
    {
        return $this->getClassByName($name, '\\Comics\\Clients');
    }

    private function getClassByName(string $name, string $namespace): string
    {
        $class = sprintf('%s\\%s', $namespace, ucfirst($name));
        if (class_exists($class)) {
            return $class;
        }

        return '';
    }

    private function getClients(): array
    {
        $data = [];
        $clients = getenv('CLIENTS');
        if ($clients) {
            $clients = explode(',', $clients);
            foreach ($clients as $client) {
                $class = $this->getClientClassByName($client);
                if (!$class || !$this->validateClientWebHookUrl($client)) {
                    continue;
                }

                $data[] = new $class();
            }
        }

        return $data;
    }

    private function validateClientWebHookUrl(string $client): bool
    {
        return (bool) getenv(sprintf('%s_WEBHOOK_URL', strtoupper($client)));
    }
}
