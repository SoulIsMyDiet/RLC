<?php

namespace Recruitment\Element;


/**
 * Class Coil
 * @package Recruitment\Element
 */
class Coil extends AbstractElement
{

    /**
     * @var string
     */
    protected $type = AbstractElement::TYPE_INDUCTION;

    /**
     * Coil constructor.
     * @param number $value
     */
    public function __construct($value)
    {
        $this->coilValidator($value);
        $this->value = $value;

    }


    /**
     * @param number $value
     */
    private function coilValidator($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Coil can not have negative value');
        }
    }
}