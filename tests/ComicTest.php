<?php

namespace ComicTests;

use Comics\Comic\CommitStrip;
use Comics\Comic\Dilbert;
use Comics\Comic\Garfield;
use Comics\Comic\Nichtlustig;
use Comics\Comic\Unnuetz;
use Comics\Comic\Xkcd;
use PHPUnit\Framework\TestCase;

final class ComicTest extends TestCase
{
    public function testCommitStrip()
    {
        $comic = new CommitStrip();
        $this->assertSame('CommitStrip', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }

    public function testDilbert()
    {
        $comic = new Dilbert();
        $this->assertSame('Dilbert', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }

    public function testGarfield()
    {
        $comic = new Garfield();
        $this->assertSame('Garfield', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }

    public function testNichtlustig()
    {
        $comic = new Nichtlustig();
        $this->assertSame('Nichtlustig', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }

    public function testUnnuetz()
    {
        $comic = new Unnuetz();
        $this->assertSame('Unnützes Wissen', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }

    public function testXkcd()
    {
        $comic = new Xkcd();
        $this->assertSame('xkcd', $comic->getName());
        $this->assertNotNull($comic->getImage());
    }
}
