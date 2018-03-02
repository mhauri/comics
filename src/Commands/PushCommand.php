<?php
declare (strict_types=1);

namespace Comics\Commands;

use Comics\Clients\ClientInterface;
use Robo\Tasks;

class PushCommand extends Tasks
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(
        ClientInterface $client
    ) {
        $this->client = $client;
    }

    /**
     * Push comics to configured channels/rooms
     */
    public function push()
    {
        $this->client->send();
    }
}
