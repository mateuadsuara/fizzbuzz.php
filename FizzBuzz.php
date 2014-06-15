<?php

class FizzBuzz {
    function __construct (){}

    public function calculateFizzBuzz($int) {
        $fizzBuzzRules = array(
            "Fizz"  => 3,
            "Buzz"  => 5,
            "Bazz"  => 7,
        );

        if ($int <= 0) throw new InvalidArgumentException;


        $appliedToInput = function ($value) use ($int) {
            return $this->isDividableBy($int, $value) || $this->contains($int, $value) || $this->isSpecialNumber($int);
        };
        $appliedRules = $this->filter_array($fizzBuzzRules, $appliedToInput);

        if(count($appliedRules) == 0) return $int;
        return implode("", array_keys($appliedRules));
    }

    private function filter_array($inputs, $callback){
        $ret = array();

        foreach ($inputs as $key => $value){
            if ($callback($value, $key)){
                $ret[$key] = $value;
            }
        }

        return $ret;
    }

    private function isDividableBy($determinedNumber, $divisor){
        return $determinedNumber % $divisor == 0;
    }

    private function contains ($container, $content){
        if(strpos($container, (string)$content) !== false) return true;
    }

    private function isSpecialNumber ($specialNumber){
        return $specialNumber == 952;
    }
} 