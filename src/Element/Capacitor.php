<?php

namespace Recruitment\Element;




use Recruitment\Exception\NullCapacitorException;

/**
 * Class Capacitor
 * @package Recruitment\Element
 */
class Capacitor extends AbstractElement
{
    /**
     * @var int
     */
    //private $value;
    /**
     * @var string
     */
    protected $type = AbstractElement::TYPE_CAPACITY;

    /**
     * Capacitor constructor.
     * @param int $value
     * @throws NullCapacitorException
     */
    public function __construct($value)
    {
        //Parent::__construct($value);
        $this->capacitorValidator($value);
        $this->value = $value;
    }

    /**
     * @param number $value
     * @throws NullCapacitorException
     */
    private function capacitorValidator($value)
    {
        if($value < 0){
            throw new \InvalidArgumentException;
        }
        if ($value == null){
            throw new NullCapacitorException;
        }
    }
}