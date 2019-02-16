<?php
/**
 * Created by PhpStorm.
 * User: anzelm
 * Date: 15.02.19
 * Time: 21:34
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Recruitment\Circuit\Element;

$element = new Element(Element::TYPE_SERIAL, \Recruitment\Element\AbstractElement::TYPE_INDUCTION);
$capacitor = new \Recruitment\Element\Capacitor(1);
echo $capacitor->getValue();
//$coil = new \Recruitment\Element\Coil(7);
//$coil2 = new \Recruitment\Element\Coil(3);
//$element->attach($coil)->attach($coil2);
//var_dump($element);