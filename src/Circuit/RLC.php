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
        if (!isset($this->sets[AbstractElement::TYPE_RESISTANCE])) {
            return 0;
        }
        return call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_RESISTANCE]);
    }

    /**
     * @return number
     */
    public function getInduction()
    {
        if (!isset($this->sets[AbstractElement::TYPE_INDUCTION])) {
            return 0;
        }
        return call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_INDUCTION]);
    }

    /**
     * @return number|null
     */
    public function getCapacity()
    {
        if (!isset($this->sets[AbstractElement::TYPE_CAPACITY])) {

            return null;
        }
        return call_user_func_array(array($this->calculator, 'reciprocal'), $this->sets[AbstractElement::TYPE_CAPACITY]);
    }

}