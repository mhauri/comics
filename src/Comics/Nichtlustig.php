<?php

declare(strict_types=1);

namespace Comics\Comics;

use GuzzleHttp\Client;

class Nichtlustig implements ComicsInterface
{
    const COMIC_NAME = 'Nichtlustig';

    const FEED_URL = 'https://gist.githubusercontent.com/mhauri/a9a7efbbddf9919d85ab136526c5bd92/raw/7015f120dca9098adf42896ae2a22dde30adb624/nichtlustig.json';

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
        $dateBack = date('ymd', strtotime('-18 years'));
        $feed = $this->getFeed();
        $items = json_decode($feed, true);
        if (isset($items[$dateBack])) {
            return $items[$dateBack]['url'];
        }

        return '';
    }

    private function getFeed()
    {
        $client = new Client();
        $result = $client->get(self::FEED_URL);

        return $result->getBody()->getContents();
    }
}
