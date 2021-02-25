<?php

declare(strict_types=1);

namespace Comics\Service;

class LockFileService
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $payload;

    public function __construct(string $url, string $name, array $payload)
    {
        $this->url = $url;
        $this->name = $name;
        $this->payload = $payload;
    }

    public function isLocked(): bool
    {
        if (file_exists($this->getLockFilePath())) {
            return $this->getPayloadHash() === $this->getLockFileContent();
        }

        return false;
    }

    public function writeLockFile()
    {
        file_put_contents(
            $this->getLockFilePath(),
            $this->getPayloadHash()
        );
    }

    public function getLockFileName(): string
    {
        return sprintf(
            '%s%s_%s',
            getenv('LOCK_FILE_PREFIX'),
            strtolower($this->name),
            sha1($this->url)
        );
    }

    public function getLockFileContent(): string
    {
        return file_get_contents($this->getLockFilePath());
    }

    public function getLockFilePath(): string
    {
        return sprintf(
            '%s/../../lock/%s.lock',
            __DIR__,
            $this->getLockFileName()
        );
    }

    public function getPayloadHash()
    {
        return sha1(json_encode($this->payload));
    }
}
