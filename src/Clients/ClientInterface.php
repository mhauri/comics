<?php

namespace Comics\Clients;

interface ClientInterface
{
    /**
     * @return $this
     */
    public function setComicName(string $name);

    /**
     * @return $this
     */
    public function setComicImage(string $image);

    /**
     * @return bool
     */
    public function send();
}
