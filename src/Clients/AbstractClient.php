<?php

declare(strict_types=1);

namespace Comics\Clients;

use Comics\Lockfile\Lockfile;
use GuzzleHttp\Client;

abstract class AbstractClient implements ClientInterface
{
    /**
     * @var string
     */
    private $name = '';
    /**
     * @var string
     */
    private $image = '';

    public function setComicName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getComicName()
    {
        return $this->name;
    }

    public function setComicImage(string $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getComicImage()
    {
        return $this->image;
    }

    protected function _send(string $uri, array $payload): bool
    {
        $client = new Client();

        if ($this->isLocked($uri)) {
            return false;
        }

        try {
            $client->post($uri, ['json' => $payload]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function isLocked(string $uri)
    {
        $lockFile = new Lockfile();
        $lockFileIdentifier = sprintf('%s_%s', $this->getComicName(), sha1($uri));

        return $lockFile->isLocked($lockFileIdentifier, $this->getComicImage());
    }
}
