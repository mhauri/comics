<?php
declare (strict_types=1);

namespace Comics\Comics;

interface ComicsInterface
{
    /**
     * @return string
     */
    public function getImage();

    /**
     * @return string
     */
    public function getName();
}
