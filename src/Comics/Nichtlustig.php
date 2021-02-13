<?php

declare(strict_types=1);

namespace Comics\Comics;

use GuzzleHttp\Client;

class Nichtlustig implements ComicsInterface
{
    const COMIC_NAME = 'Nichtlustig';

    const FEED_URL = 'https://joscha.com/rss/all';

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
        $feed = $this->getFeed();
        $xml = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
        $array = json_decode(json_encode((array) $xml), true);
        $dom = new \DOMDocument();
        $dom->loadHTML($array['channel']['item'][0]['description']);

        $xpath = new \DOMXPath($dom);
        $src = $xpath->evaluate('string(//img/@src)');

        return $src;
    }

    private function getFeed()
    {
        $client = new Client();
        $result = $client->get(self::FEED_URL);

        return $result->getBody()->getContents();
    }
}
