<?php

namespace Comics\Clients;

interface ClientInterface
{
    public function setUrl(string $url);
    public function setPayload(array $payload);
    public function send();
}
