<?php

namespace Recruitment\Tests\Element;

use PHPUnit\Framework\TestCase;
use Recruitment\Element\AbstractElement;
use Recruitment\Element\Capacitor;

class CapacitorTest extends TestCase
{
    /**
     * @test
     */
    public function newCapacitorTest()
    {
        $capacitor = new Capacitor(1);

        $this->assertEquals(1, $capacitor->getValue());
        $this->assertEquals(AbstractElement::TYPE_CAPACITY, $capacitor->getType());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionWhenInvalidValue()
    {
        new Capacitor(-1);
    }

    /**
     * @test
     * @expectedException \Recruitment\Exception\NullCapacitorException
     */
    public function throwExceptionWhenUnsupportedElement()
    {
        new Capacitor(0);
    }
}