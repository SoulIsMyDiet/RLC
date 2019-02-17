<?php
/**
 * Created by PhpStorm.
 * User: anzelm
 * Date: 15.02.19
 * Time: 21:34
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Recruitment\Circuit\Element;
use Recruitment\Circuit\RLC;
use Recruitment\Element\AbstractElement;
use Recruitment\Element\Capacitor;
use Recruitment\Element\Coil;
use Recruitment\Element\Resistor;

try {
//    $element = new Element('lol', \Recruitment\Element\AbstractElement::TYPE_INDUCTION);


//$element = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_INDUCTION);

//$item = new \Recruitment\Element\Capacitor(-1);

    $rlc = new RLC();

    $resistance = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_RESISTANCE);
    $resistance->attach(new Resistor(1))->attach(new Resistor(2))->attach(new Resistor(3));

    $induction = new Element(Element::TYPE_SERIAL, AbstractElement::TYPE_INDUCTION);
    $induction->attach(new Coil(1))->attach(new Coil(2))->attach(new Coil(3));

    $capacity = new Element(Element::TYPE_PARALLEL, AbstractElement::TYPE_CAPACITY);
    $capacity->attach(new Capacitor(1))->attach(new Capacitor(2))->attach(new Capacitor(3));

    $rlc->attachElement($resistance)->attachElement($induction)->attachElement($capacity)
        ->attachElement($resistance)->attachElement($induction)->attachElement($capacity);

    echo $rlc->getResistance();


//$element->attach($item);
}catch (Exception $e){
    echo $e->getMessage();
}
//$capacitor = new \Recruitment\Element\Capacitor(1);
//echo $capacitor->getValue();
//$coil = new \Recruitment\Element\Coil(7);
//$coil2 = new \Recruitment\Element\Coil(3);
//$element->attach($coil)->attach($coil2);
//var_dump($element);