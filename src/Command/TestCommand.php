<?php

declare(strict_types=1);

namespace Comics\Command;

use Robo\Tasks;

class TestCommand extends Tasks
{
    /**
     * Run unit tests.
     *
     * @codeCoverageIgnore
     */
    public function test()
    {
        $this->taskExecStack()
            ->stopOnFail()
            ->exec('./tests/server/start.sh')
            ->exec('./vendor/bin/phpunit --testdox')
            ->exec('./tests/server/stop.sh')
            ->run();
    }
}
