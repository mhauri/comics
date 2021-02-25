<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;
use Comics\Service\HttpClientService;

class Garfield implements ComicInterface
{
    public function getName(): string
    {
        return 'Garfield';
    }

    public function getImage(): string
    {
        $httpClientService = new HttpClientService();
        $contents = $httpClientService->get(
            sprintf(
                'https://www.gocomics.com/garfield/%s',
                date('Y/m/d')
            )
        );

        preg_match_all('/data-image="(https:\/\/assets.[^"]+)"/', $contents, $matches);

        return $matches[1][0];
    }
}
