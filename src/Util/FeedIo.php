<?php

namespace App\Util;

use FeedIo\FeedInterface;

class FeedIo
{

    /**
     * @var \FeedIo\FeedIo
     */
    private $feedIo;

    public function __construct()
    {
        $this->feedIo = \FeedIo\Factory::create()->getFeedIo();
    }

    /**
     * reads feed url and return result object
     *
     * @param string $url
     * @return FeedInterface
     */
    public function read(string $url)
    {
        return $this->feedIo->read($url)->getFeed();
    }

}