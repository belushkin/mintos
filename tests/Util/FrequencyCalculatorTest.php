<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Util\FrequencyCalculator;

class FrequencyCalculatorTest extends TestCase
{
    public function testFrequencyOfWords()
    {
        $calculator = new FrequencyCalculator();
        $this->assertEquals(
            ['three'=>3, 'two'=>2, 'one'=>1],
            $calculator->get10FrequentWords('one two three two three three')
        );
    }

}
