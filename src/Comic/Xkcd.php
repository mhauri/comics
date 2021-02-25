<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;
use Comics\Service\HttpClientService;

class Xkcd implements ComicInterface
{
    public function getName(): string
    {
        return 'xkcd';
    }

    public function getImage(): string
    {
        $httpClientService = new HttpClientService();
        $feed = $httpClientService->get('https://xkcd.com/rss.xml');
        $xml = simplexml_load_string($feed);
        $imageHtml = (string) $xml->channel->item->description;

        $exp = '/^.*?(https?\\:\\/\\/[^\\" ]+)/';
        preg_match_all($exp, $imageHtml, $data);

        return $data[1][0];
    }
}
