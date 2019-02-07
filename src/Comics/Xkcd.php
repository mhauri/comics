<?php
declare(strict_types=1);

namespace Comics\Comics;

class Xkcd implements ComicsInterface
{
    const COMIC_NAME = 'XKCD';

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
        $rss = simplexml_load_file(self::FEED_URL);
        $img = $rss->channel->item->description;

        $exp = "/^.*?(https?\\:\\/\\/[^\\\" ]+)/";
        preg_match_all($exp, $img, $url);

        return $url[1][0];
    }
}
