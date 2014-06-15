<?php

interface Rule {
    public function isApplied($input);
}

class DividableBy implements Rule {
    private $divisor;

    public function __construct($divisor){
        $this->divisor = $divisor;
    }

    public function isApplied($determinedNumber){
        return $determinedNumber % $this->divisor == 0;
    }
}

class Contains implements Rule {
    private $content;

    public function __construct($content){
        $this->content = $content;
    }

    public function isApplied($container) {
        if(strpos($container, (string)$this->content) !== false) return true;
    }
}

class Is implements Rule {
    private $specialNumber;

    public function __construct($specialNumber){
        $this->specialNumber = $specialNumber;
    }

    public function isApplied($input){
        return $this->specialNumber == $input;
    }
}

class FizzBuzz {
    function __construct (){}

    public function calculateFizzBuzz($int) {
        $fizzBuzzRules = array(
            "Fizz"  => array(
                new DividableBy(3),
                new Contains(3),
                new Is(954)
            ),
            "Buzz"  => array(
                new DividableBy(5),
                new Contains(5),
                new Is(954),
                new Is(966)
            ),
            "Bazz"  => array(
                new DividableBy(7),
                new Contains(7),
                new Is(954)
            )
        );

        if ($int <= 0) throw new InvalidArgumentException;


        $appliedToInput = function ($value) use ($int) {
            $ruleApplied = false;
            foreach ($value as $rulesName => $rule){
                $ruleApplied = $ruleApplied || $rule->isApplied($int);
            }
            return $ruleApplied;
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
} 