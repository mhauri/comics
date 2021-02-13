<?php

declare(strict_types=1);

namespace Comics\Comics;

use GuzzleHttp\Client;

class Xkcd implements ComicsInterface
{
    const COMIC_NAME = 'xkcd';

    const FEED_URL = 'https://xkcd.com/rss.xml';

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
        $imageHtml = (string) $xml->channel->item->description;

        $exp = '/^.*?(https?\\:\\/\\/[^\\" ]+)/';
        preg_match_all($exp, $imageHtml, $data);

        return $data[1][0];
    }

    private function getFeed()
    {
        $client = new Client();
        $result = $client->get(self::FEED_URL);

        return $result->getBody()->getContents();
    }
}
