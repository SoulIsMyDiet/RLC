<?php


namespace Recruitment\Circuit;


use InvalidArgumentException;
use Recruitment\Calculator;
use Recruitment\Element\AbstractElement;
use Recruitment\Exception\UnsupportedElementException;

/**
 * Class Element
 * @package Recruitment\Circuit
 */
class Element
{
    const TYPE_SERIAL = 'S';
    const TYPE_PARALLEL = 'P';

    /**
     * @var string
     */
    private $connectionType;
    /**
     * @var string
     */
    private $abstractType;
    /**
     * @var array
     */
    private $elementsInSet = [];
    /**
     * @var Calculator
     */
    private $calculator;
    private $setsValue;

    /**
     * @return mixed
     */
    public function getSetsValue()
    {
        return $this->setsValue;
    }


    /**
     * @return string
     */
    public function getAbstractType()
    {
        return $this->abstractType;
    }

    /**
     * Element constructor.
     * @param string $connectionType
     * @param string $abstractType
     */
    public function __construct($connectionType, $abstractType)
    {
        $elementReflection = new \ReflectionClass(self::class);
        if (!in_array($connectionType, $elementReflection->getConstants())) {
            throw new InvalidArgumentException;
        }
        $abstractElementReflection = new \ReflectionClass(AbstractElement::class);
        if (!in_array($abstractType, $abstractElementReflection->getConstants())) {
            throw new InvalidArgumentException;
        }

        $this->connectionType = $connectionType;
        $this->abstractType = $abstractType;
        $this->calculator = new Calculator();
    }

    /**
     * @param AbstractElement $element
     * @return $this
     * @throws UnsupportedElementException
     */
    public function attach(AbstractElement $element)
    {
        if ($element->getType() !== $this->abstractType) {
            throw new UnsupportedElementException('what?');
        }
        $this->elementsInSet[] = $element->getValue();
        return $this;
    }

    /**
     * Dependly on element-connection and type of elements, calculate value for this elements set
     */
    public function calculate()
    {
        switch ($this->abstractType) {
            case AbstractElement::TYPE_RESISTANCE:
            case AbstractElement::TYPE_INDUCTION:
                if ($this->connectionType == self::TYPE_SERIAL) {
                   $result = call_user_func_array(array($this->calculator, 'strait'), $this->elementsInSet);
                } else {
                    $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->elementsInSet);

                }
                break;
            case AbstractElement::TYPE_CAPACITY:
                if ($this->connectionType == self::TYPE_SERIAL) {
                    //$this->calculator->reciprocal($this->elementsSet);
                    $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->elementsInSet);

                } else {
                   // $this->calculator->strait($this->elementsSet);
                    $result = call_user_func_array(array($this->calculator, 'strait'), $this->elementsInSet);

                }
                break;
            Default:
                throw new InvalidArgumentException;
                break;

        }
        $this->setsValue = $result;
        //echo $result.'lol';
        return $result;
    }
}