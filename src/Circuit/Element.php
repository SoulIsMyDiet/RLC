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
     * Array of which calculation we should use in case of element type and connection type
     *
     * @var array
     */
    public static $howToCalculate = [
        'strait' => [
            AbstractElement::TYPE_RESISTANCE => Element::TYPE_SERIAL,
            AbstractElement::TYPE_INDUCTION => Element::TYPE_SERIAL,
            AbstractElement::TYPE_CAPACITY => Element::TYPE_PARALLEL
        ],
        'reciprocal' => [
            AbstractElement::TYPE_RESISTANCE => Element::TYPE_PARALLEL,
            AbstractElement::TYPE_INDUCTION => Element::TYPE_PARALLEL,
            AbstractElement::TYPE_CAPACITY => Element::TYPE_SERIAL
        ]
    ];
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
    /**
     * @var number
     */
    private $setsValue;

    /**
     * @return number
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
     * Dependably on element-connection and type of elements, it chooses which calculation use for this elements set
     *
     * @return number
     *
     */
    public function calculate()
    {

        $keys = array_keys(self::$howToCalculate);

        //In human language it looks like this: call_user_func_array(array($calculatorInstance, 'strait/reciprocal'), array($value1, $value2));
        $result = call_user_func_array(array($this->calculator,
                $keys[array_search($this->connectionType, array_column(self::$howToCalculate, $this->abstractType))])
            , $this->elementsInSet);

//        switch ($this->abstractType) {
//            case AbstractElement::TYPE_RESISTANCE:
//            case AbstractElement::TYPE_INDUCTION:
//                if ($this->connectionType == self::TYPE_SERIAL) {
//                    $result = call_user_func_array(array($this->calculator, 'strait'), $this->elementsInSet);
//                } else {
//                    $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->elementsInSet);
//
//                }
//                break;
//            case AbstractElement::TYPE_CAPACITY:
//                if ($this->connectionType == self::TYPE_SERIAL) {
//                    $result = call_user_func_array(array($this->calculator, 'reciprocal'), $this->elementsInSet);
//
//                } else {
//                    $result = call_user_func_array(array($this->calculator, 'strait'), $this->elementsInSet);
//
//                }
//                break;
//            Default:
//                throw new InvalidArgumentException;
//                break;
//
//        }
        $this->setsValue = $result;
        return $result;
    }

    /**
     * Element constructor.
     * @param string $connectionType
     * @param string $abstractType
     * @throws \ReflectionException
     */
    public function __construct($connectionType, $abstractType)
    {
        $this->elementValidator($connectionType, $abstractType);

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
            throw new UnsupportedElementException('Unsupported element');
        }
        $this->elementsInSet[] = $element->getValue();
        return $this;
    }

    /**
     * @param $connectionType
     * @param $abstractType
     * @throws \ReflectionException
     */
    private function elementValidator($connectionType, $abstractType)
    {
        $elementReflection = new \ReflectionClass(self::class);
        if (!in_array($connectionType, $elementReflection->getConstants())) {
            throw new InvalidArgumentException('You must put an existing connection type');
        }
        $abstractElementReflection = new \ReflectionClass(AbstractElement::class);
        if (!in_array($abstractType, $abstractElementReflection->getConstants())) {
            throw new InvalidArgumentException('You must put an existing element type');
        }
    }

}