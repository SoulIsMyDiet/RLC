<?php

namespace Recruitment\Tests\Element;

use PHPUnit\Framework\TestCase;
use Recruitment\Circuit\Element;
use Recruitment\Circuit\RLC;
use Recruitment\Element\AbstractElement;
use Recruitment\Element\Capacitor;
use Recruitment\Element\Coil;
use Recruitment\Element\Resistor;

class RLCTest extends TestCase
{
    /**
     * @test
     */
    public function newObjectTest()
    {
        $rlc = new RLC();

        $this->assertEquals(0, $rlc->getResistance());
        $this->assertEquals(0, $rlc->getInduction());
        $this->assertNull($rlc->getCapacity());
    }

    /**
     * @test
     *//**/
    public function attachElementTest()
    {
        $rlc = new RLC();

        $resistance = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_RESISTANCE);
        $resistance->attach(new Resistor(1))->attach(new Resistor(2))->attach(new Resistor(3));

        $induction = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_INDUCTION);
        $induction->attach(new Coil(1))->attach(new Coil(2))->attach(new Coil(3));

        $capacity = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_CAPACITY);
        $capacity->attach(new Capacitor(1))->attach(new Capacitor(2))->attach(new Capacitor(3));

        $rlc->attachElement($resistance)->attachElement($induction)->attachElement($capacity)
            ->attachElement($resistance)->attachElement($induction)->attachElement($capacity);

        $this->assertEquals(12, $rlc->getResistance());
        $this->assertEquals(12, $rlc->getInduction());
        $this->assertEquals(3, $rlc->getCapacity());
    }
}