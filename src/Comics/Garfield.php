<?php
declare (strict_types=1);

namespace Comics\Comics;


class Garfield implements ComicsInterface
{
    const COMIC_NAME = 'Garfield';

    const IMAGE_URL = 'https://s3.amazonaws.com/static.garfield.com/comics/garfield/%s/%s.gif';

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
        return sprintf(
                self::IMAGE_URL,
                date('Y'),
                date('Y-m-d')
                );
    }
}
