<?php

declare(strict_types=1);

namespace Comics\Comics;

use GuzzleHttp\Client;

class Garfield implements ComicsInterface
{
    const COMIC_NAME = 'Garfield';

    const PAGE_URL = 'https://www.gocomics.com/garfield/%s';

    /**
     * @return string
     */
    public function getName()
    {
        return self::COMIC_NAME;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $contents = $this->getPageContents();

        preg_match_all('/data-image="(https:\/\/assets.[^"]+)"/', $contents, $matches);

        return $matches[1][0];
    }

    private function getPageContents()
    {
        $url = sprintf(self::PAGE_URL, date('Y/m/d'));

        $client = new Client();
        $result = $client->get($url);

        return $result->getBody()->getContents();
    }
}
