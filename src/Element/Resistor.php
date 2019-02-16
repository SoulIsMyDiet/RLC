<?php

namespace Recruitment\Element;


/**
 * Class Resistor
 * @package Recruitment\Element
 */
class Resistor extends AbstractElement
{
    /**
     * @var int
     */
   // private $value;
    /**
     * @var string
     */
    protected $type = AbstractElement::TYPE_RESISTANCE;

    /**
     * Coil constructor.
     * @param number $value
     */
    public function __construct($value)
    {
        $this->resistorValidator($value);
        $this->value = $value;

    }


    /**
     * @param number $value
     */
    private function resistorValidator($value)
    {
        if($value < 0){
            throw new \InvalidArgumentException;
        }
    }


}