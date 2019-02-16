<?php

namespace Recruitment\Exception;


class UnsupportedElementException extends \Exception
{
    /**
     * UnsupportedElementException constructor.
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

}