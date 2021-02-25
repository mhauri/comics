<?php

declare(strict_types=1);

namespace Comics;

interface ComicInterface
{
    public function getImage(): string;

    public function getName(): string;
}
