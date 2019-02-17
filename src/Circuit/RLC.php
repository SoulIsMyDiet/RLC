<?php

namespace Recruitment\Circuit;



use Recruitment\Calculator;
use Recruitment\Element\AbstractElement;

class RLC
{

    /**
     * @var array
     */
    private $sets = [];
    private $calculator;

    /**
     * RLC constructor.
     * @param array $sets
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
        //echo $element->getSetsValue().'lol2';
        print_r($this->sets);
        return $this;
    }

    public function getResistance()
    {
        //print_r($this->sets[AbstractElement::TYPE_RESISTANCE]);
        //if($this->sets[AbstractElement::TYPE_RESISTANCE])
        if(!array_key_exists(AbstractElement::TYPE_RESISTANCE, $this->sets)){
            return 0;
        }
        $result = call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_RESISTANCE]);

        return $result;
    }

    public function getInduction()
    {
        if(!array_key_exists(AbstractElement::TYPE_INDUCTION, $this->sets)){
            return 0;
        }
        $result = call_user_func_array(array($this->calculator, 'strait'), $this->sets[AbstractElement::TYPE_INDUCTION]);

        return $result;
    }

    public function getCapacity()
    {
        if(!array_key_exists(AbstractElement::TYPE_CAPACITY, $this->sets)){
            return null;
        }
        $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->sets[AbstractElement::TYPE_CAPACITY]);

        return $result;
    }
}