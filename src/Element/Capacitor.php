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
        parent::__construct($value);
        $this->capacitorValidator($value);
        $this->value = $value;
    }

    /**
     * @param number $value
     * @throws NullCapacitorException
     */
    private function capacitorValidator($value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('The capacitor cannot have negative value');
        }
        if ($value == null) {
            throw new NullCapacitorException('The capacitor cannot be empty');
        }
    }

}