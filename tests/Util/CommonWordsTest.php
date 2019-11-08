<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Util\CommonWords;

class CommonWordsTest extends TestCase
{
    public function testRemoveCommonWordsFromString()
    {
        $commonWords = new CommonWords();
        $this->assertEquals(" ", $commonWords->exclude50CommonWords("so up"));
    }

}