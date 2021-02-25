<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;
use Comics\Service\HttpClientService;

class Dilbert implements ComicInterface
{
    public function getName(): string
    {
        return 'Dilbert';
    }

    public function getImage(): string
    {
        $httpClientService = new HttpClientService();
        $contents = $httpClientService->get(
            sprintf(
                'https://www.dilbert.com/strip/%s',
                date('Y-m-d')
            )
        );

        preg_match_all('/data-image="(https:\/\/assets.[^"]+)"/', $contents, $matches);

        return $matches[1][0];
    }
}
