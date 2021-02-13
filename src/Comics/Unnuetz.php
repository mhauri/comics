<?php

declare(strict_types=1);

namespace Comics\Comics;

class Unnuetz implements ComicsInterface
{
    const COMIC_NAME = 'Unnützes Wissen';

    const FEED_URL = 'https://www.xn--unntzes-wissen-isb.de/img/wissen/unnuetzes-Wissen-';

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
        return self::FEED_URL.date('j.n.Y').'.jpg';
    }
}
