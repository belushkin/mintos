<?php

namespace App\Tests\Service;

use App\Tests\Service\IteratorStub;
use PHPUnit\Framework\TestCase;
use App\Service\FeedClient;
use App\Util\FeedIo;
use App\Util\FeedTransformer;

class FeedClientTest extends TestCase
{
    public function testReadingFeed()
    {
        $feedIoStub = $this->createMock(FeedIo::class);
        $feedIoStub->method('read')
            ->willReturn(new IteratorStub());

        $feedClient = new FeedClient($feedIoStub, new FeedTransformer());
        $feedClient->setUrl('localhost');
        $this->assertEquals(new IteratorStub(), $feedClient->read());
    }

}
