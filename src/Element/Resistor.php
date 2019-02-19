<?php

namespace Recruitment\Element;


/**
 * Class Resistor
 * @package Recruitment\Element
 */
class Resistor extends AbstractElement
{

    /**
     * @var string
     */
    protected $type = AbstractElement::TYPE_RESISTANCE;


    /**
     * Resistor constructor.
     * @param number $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
        $this->resistorValidator($value);
        $this->value = $value;

    }


    /**
     * @param number $value
     */
    private function resistorValidator($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Resistor cannot have negative value');
        }
    }

}