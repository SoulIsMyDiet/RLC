<?php

namespace Recruitment\Tests\Element;

use PHPUnit\Framework\TestCase;
use Recruitment\Element\AbstractElement;
use Recruitment\Element\Resistor;

class ResistorTest extends TestCase
{
    /**
     * @test
     */
    public function newResistorTest()
    {
        $resistor = new Resistor(1);

        $this->assertEquals(1, $resistor->getValue());
        $this->assertEquals(AbstractElement::TYPE_RESISTANCE, $resistor->getType());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionWhenInvalidValue()
    {
        new Resistor(-1);
    }
}