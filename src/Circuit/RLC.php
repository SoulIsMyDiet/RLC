<?php

namespace Recruitment\Circuit;


use Recruitment\Calculator;
use Recruitment\Element\AbstractElement;

/**
 * Class RLC
 * @package Recruitment\Circuit
 */
class RLC
{

    /**
     * @var array
     */
    private $sets = [];
    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * RLC constructor.
     */
    public function __construct()
    {
        $this->calculator = new Calculator();
    }

    /**
     * @param Element $element
     * @return $this
     */
    public function attachElement(Element $element)
    {
        $element->calculate();
        $this->sets[$element->getAbstractType()][] = $element->getSetsValue();
        return $this;
    }

    /**
     * @return number
     */
    public function getResistance()
    {
        if (!array_key_exists(AbstractElement::TYPE_RESISTANCE, $this->sets)) {
            return 0;
        }
        $result = call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_RESISTANCE]);

        return $result;
    }

    /**
     * @return number
     */
    public function getInduction()
    {
        if (!array_key_exists(AbstractElement::TYPE_INDUCTION, $this->sets)) {
            return 0;
        }
        $result = call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_INDUCTION]);

        return $result;
    }

    /**
     * @return number|null
     */
    public function getCapacity()
    {
        if (!array_key_exists(AbstractElement::TYPE_CAPACITY, $this->sets)) {
            return null;
        }
        $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->sets[AbstractElement::TYPE_CAPACITY]);

        return $result;
    }
}