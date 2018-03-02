<?php
declare (strict_types=1);

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

    /**
     * @var string
     */
    private $webHookUrl = '';

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

    protected function _send(string $uri, array $payload) : bool
    {
        $client = new Client();
        $lockFile = new Lockfile();

        if($lockFile->isLocked($this->getComicName(), $this->getComicImage())) {
            return false;
        }

        try {
            $client->post($uri, ['json' => $payload]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
