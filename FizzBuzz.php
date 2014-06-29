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
    private $rules;

    function __construct ($rules){
        $this->rules = $rules;
    }

    public function calculateFizzBuzz($int) {
        if ($int <= 0) throw new InvalidArgumentException;


        $appliedToInput = function ($value) use ($int) {
            $ruleApplied = false;
            foreach ($value as $rulesName => $rule){
                $ruleApplied = $ruleApplied || $rule->isApplied($int);
            }
            return $ruleApplied;
        };
        $appliedRules = $this->filter_array($this->rules, $appliedToInput);

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