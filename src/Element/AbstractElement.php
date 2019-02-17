<?php


namespace Recruitment\Element;


/**
 * Class AbstractElement
 * @package Recruitment\Element
 */
abstract class AbstractElement
{


    const TYPE_CAPACITY = 'C';
    const TYPE_INDUCTION = 'I';
    const TYPE_RESISTANCE = 'R';
    /**
     * @var number
     */
    protected $value;
    /**
     * @var string
     */
    protected $type;

    /**
     * AbstractElement constructor.
     * @param number $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }


    /**
     * @return number
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

}