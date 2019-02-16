<?php
/**
 * Created by PhpStorm.
 * User: anzelm
 * Date: 13.02.19
 * Time: 20:27
 */

namespace Recruitment\Exception;


class NullCapacitorException extends \Exception
{

    /**
     * NullCapacitorException constructor.
     */
    public function __construct($message)
    {
        parent::__construct($message);

    }
}