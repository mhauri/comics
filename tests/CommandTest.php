<?php

namespace ComicTests;

use Comics\Command\ComicCommand;
use Comics\Exception\ClassNotFoundException;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    private $lockfile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lockfile = __DIR__.'/../lock/test_dilbert_f5f64e08e552ca1de4feba65ecd6d7b8158f7a86.lock';
    }

    public function testSendComicComicNotFoundException()
    {
        $this->expectException(ClassNotFoundException::class);
        $comic = new ComicCommand();
        $comic->sendComic('test');
    }

    public function testSendComic()
    {
        $comic = new ComicCommand();
        $comic->sendComic('dilbert');
        $this->assertFileExists($this->lockfile);
    }

    public function testSendComicWithLockFile()
    {
        $comic = new ComicCommand();
        $comic->sendComic('dilbert');
        $comic->sendComic('dilbert');
        $this->assertFileExists($this->lockfile);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (file_exists($this->lockfile)) {
            unlink($this->lockfile);
        }
    }
}
