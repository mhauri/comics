<?php

declare(strict_types=1);

namespace Comics\Comics;

use GuzzleHttp\Client;

class CommitStrip implements ComicsInterface
{
    const COMIC_NAME = 'CommitStrip';

    const FEED_URL = 'http://www.commitstrip.com/en/feed/';

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
        $xml = simplexml_load_string($feed);
        $imageHtml = (string) $xml->channel->item[0]->children('content', true)->encoded;
        $doc = new \DOMDocument();
        $doc->loadHTML($imageHtml);
        $imageTags = $doc->getElementsByTagName('img');

        return (string) $imageTags->item(0)->getAttribute('src') ?? '';
    }

    private function getFeed()
    {
        $client = new Client();
        $result = $client->get(self::FEED_URL);

        return $result->getBody()->getContents();
    }
}
