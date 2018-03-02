<?php

namespace Comics\Clients;

interface ClientInterface
{
    /**
     * @param string $name
     * @return $this
     */
    public function setComicName(string $name);
    /**
     * @param string $image
     * @return $this
     */
    public function setComicImage(string $image);

    /**
     * @return bool
     */
    public function send();
}
