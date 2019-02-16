<?php

namespace Recruitment\Tests\Calculator;

use Recruitment\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function straitTest()
    {
        $calculator = new Calculator();

        $this->assertEquals(6, $calculator->strait(1,2,3));
        $this->assertEquals(0, $calculator->strait());
    }

    /**
     * @test
     */
    public function reciprocalTest()
    {
        $calculator = new Calculator();

        $this->assertEquals(6 / 11, $calculator->reciprocal(1,2,3));
        $this->assertEquals(0, $calculator->reciprocal(1,2,0));
    }
}