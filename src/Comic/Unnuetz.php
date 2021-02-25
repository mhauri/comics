<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;

class Unnuetz implements ComicInterface
{
    public function getName(): string
    {
        return 'Unnützes Wissen';
    }

    public function getImage(): string
    {
        return
            sprintf(
                'https://www.xn--unntzes-wissen-isb.de/img/wissen/unnuetzes-Wissen-%s.jpg',
                date('j.n.Y')
            );
    }
}
