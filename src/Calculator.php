<?php

namespace Recruitment;

class Calculator
{
    /**
     * @param number ...$numbers
     * @return int|mixed
     */
    public function strait(...$numbers){
        $result = 0;
        foreach ($numbers as $number) {
            $result += $number;
        }
        return $result;
    }


    /**
     * @param number ...$numbers
     * @return float|int
     */
    public function reciprocal(...$numbers){
        $result = 0;
        foreach ($numbers as $number) {
            if($number === 0){
                return 0;//pomyslec o jakims exceptionie
            }
            $result += 1/$number;
        }
        return 1/$result;
    }
}