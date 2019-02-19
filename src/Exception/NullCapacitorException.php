<?php

namespace Recruitment\Exception;


class NullCapacitorException extends \Exception
{


    /**
     * NullCapacitorException constructor.
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message);

    }

}