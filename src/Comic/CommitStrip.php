<?php

declare(strict_types=1);

namespace Comics\Comic;

use Comics\ComicInterface;
use Comics\Service\HttpClientService;

class CommitStrip implements ComicInterface
{
    public function getName(): string
    {
        return 'CommitStrip';
    }

    public function getImage(): string
    {
        $httpClientService = new HttpClientService();
        $feed = $httpClientService->get('http://www.commitstrip.com/en/feed/');
        $xml = simplexml_load_string($feed);
        $imageHtml = (string) $xml->channel->item[0]->children('content', true)->encoded;
        $doc = new \DOMDocument();
        $doc->loadHTML($imageHtml);
        $imageTags = $doc->getElementsByTagName('img');

        return (string) $imageTags->item(0)->getAttribute('src') ?? '';
    }
}
