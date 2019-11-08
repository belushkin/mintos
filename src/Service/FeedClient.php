<?php

namespace App\Service;

use App\Util\FeedIo;
use App\Util\FeedTransformer;
use Iterator;

class FeedClient
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * @var FeedIo
     */
    private $feedIo;

    /**
     * @var FeedTransformer
     */
    private $feedTransformer;

    /**
     * @param FeedIo $feedIo
     * @param FeedTransformer $feedTransformer
     */
    public function __construct(FeedIo $feedIo, FeedTransformer $feedTransformer)
    {
        $this->feedIo = $feedIo;
        $this->feedTransformer = $feedTransformer;
    }

    /**
     * reads feed url and return result object
     *
     * @return Iterator
     */
    public function read(): Iterator
    {
        if (empty($this->getUrl())) {
            throw new \RuntimeException('Url is empty');
        }

        return $this->feedIo->read($this->getUrl());
    }

    /**
     * Iterate over result feed and take title and description of the feed item and glue it together
     *
     * @param Iterator $result
     * @return string
     */
    public function getWordsAsString(Iterator $result): string
    {
        $words = '';
        foreach( $result as $item ) {
            $words .= $this->feedTransformer->transform($item->getDescription());
            $words .= $this->feedTransformer->transform($item->getTitle());
        }
        return $words;
    }

    /**
     * set feed url
     *
     * @param string $url
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * return feed url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}
