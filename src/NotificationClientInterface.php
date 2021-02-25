<?php

namespace Comics;

interface NotificationClientInterface
{
    public function notify(string $name, string $image);
}
