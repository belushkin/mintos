<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Util\FeedTransformer;

class FeedTransformerTest extends TestCase
{
    public function testStripTagsFromString()
    {
        $transformer = new FeedTransformer();
        $this->assertEquals("so up", $transformer->transform("<br/>so up"));
    }

}