<?php

namespace Recruitment\Tests\Element;

use PHPUnit\Framework\TestCase;
use Recruitment\Circuit\Element;
use Recruitment\Element\AbstractElement;
use Recruitment\Element\Capacitor;
use Recruitment\Element\Coil;
use Recruitment\Element\Resistor;

class ElementTest extends TestCase
{
    /**
     * @test
     */
    public function serialResistanceTest()
    {
        $element = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_RESISTANCE);

        $item1 = new Resistor(1);
        $item2 = new Resistor(2);
        $item3 = new Resistor(0);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(3, $element->calculate());
    }

    /**
     * @test
     */
    public function parallelResistanceTest()
    {
        $element = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_RESISTANCE);

        $item1 = new Resistor(1);
        $item2 = new Resistor(2);
        $item3 = new Resistor(0);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(0, $element->calculate());
    }

    /**
     * @test
     */
    public function serialCapacityTest()
    {
        $element = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_CAPACITY);

        $item1 = new Capacitor(1);
        $item2 = new Capacitor(2);
        $item3 = new Capacitor(3);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(6 / 11, $element->calculate());
    }

    /**
     * @test
     */
    public function parallelCapacityTest()
    {
        $element = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_CAPACITY);

        $item1 = new Capacitor(1);
        $item2 = new Capacitor(2);
        $item3 = new Capacitor(3);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(6, $element->calculate());
    }

    /**
     * @test
     */
    public function serialInductionTest()
    {
        $element = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_INDUCTION);

        $item1 = new Coil(1);
        $item2 = new Coil(2);
        $item3 = new Coil(3);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(6, $element->calculate());
    }

    /**
     * @test
     */
    public function parallelInductionTest()
    {
        $element = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_INDUCTION);

        $item1 = new Coil(1);
        $item2 = new Coil(2);
        $item3 = new Coil(3);

        $element->attach($item1)
            ->attach($item2)
            ->attach($item3);

        $this->assertEquals(6 / 11, $element->calculate());
    }

    /**
     * @test
     * @expectedException \Recruitment\Exception\UnsupportedElementException
     */
    public function throwExceptionWhenUnsupportedElement()
    {
        $element = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_INDUCTION);

        $item = new Resistor(2);

        $element->attach($item);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionWhenInvalidConnectionType()
    {
        new Element('InvalidConnection', AbstractElement::TYPE_INDUCTION);
    }
}