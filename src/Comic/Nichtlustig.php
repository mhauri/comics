<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;
use Comics\Service\HttpClientService;

class Nichtlustig implements ComicInterface
{
    public function getName(): string
    {
        return 'Nichtlustig';
    }

    public function getImage(): string
    {
        $httpClientService = new HttpClientService();
        $feed = $httpClientService->get('https://joscha.com/rss/all');
        $xml = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
        $array = json_decode(json_encode((array) $xml), true);
        $dom = new \DOMDocument();
        $dom->loadHTML($array['channel']['item'][0]['description']);

        $xpath = new \DOMXPath($dom);
        $src = $xpath->evaluate('string(//img/@src)');

        return $src;
    }
}
