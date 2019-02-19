<?php

namespace Recruitment;

/**
 * Class Calculator
 * @package Recruitment
 */
class Calculator
{
    /**
     * @param number ...$numbers
     * @return number
     */
    public function strait(...$numbers)
    {

        $result = 0;
        foreach ($numbers as $number) {
            $result += $number;
        }
        return $result;
    }


    /**
     * @param number ...$numbers
     * @return number
     */
    public function reciprocal(...$numbers)
    {
        $result = 0;
        foreach ($numbers as $number) {
            if ($number === 0) {
                return 0;
            }
            $result += 1 / $number;
        }
        return 1 / $result;
    }

}