<?php
/**
 * Created by PhpStorm.
 * User: anzelm
 * Date: 15.02.19
 * Time: 21:31
 */

namespace Recruitment\Circuit;


use Recruitment\Calculator;
use Recruitment\Element\AbstractElement;

class Element
{
    const TYPE_SERIAL = 'S';
    const TYPE_PARALLEL = 'P';

    private $elementType;
    private $abstractType;
    private $elementsSet = [];
    private $calculator;

    /**
     * Element constructor.
     * @param string $type
     * @param string $abstractType
     */
    public function __construct($type, $abstractType)
    {
        $this->elementType = $type;
        $this->abstractType = $abstractType;
        $this->calculator = new Calculator();
    }

    public function attach(AbstractElement $item1)
    {
        $this->elementsSet[] = $item1->getValue();
        return $this;
    }

    public function calculate()
    {
        switch ($this->abstractType){
            case AbstractElement::TYPE_RESISTANCE:
            case AbstractElement::TYPE_INDUCTION:
if($this->elementType == self::TYPE_SERIAL){
$this->calculator->strait($this->elementsSet);
}else{
    $this->calculator->reciprocal($this->elementsSet);
}
break;
            case AbstractElement::TYPE_CAPACITY:
                if($this->elementType == self::TYPE_SERIAL){
                    $this->calculator->reciprocal($this->elementsSet);
                }else{
                    $this->calculator->strait($this->elementsSet);
                }
                break;
            Default:

        }
    }
}