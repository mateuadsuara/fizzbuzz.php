<?php

interface Rule {
    public function isApplied($input);
}

class DividableBy implements Rule {
    private $divisor;

    public function __construct($divisor) {
        $this->divisor = $divisor;
    }

    public function isApplied($determinedNumber) {
        return $determinedNumber % $this->divisor == 0;
    }
}

class Contains implements Rule {
    private $content;

    public function __construct($content) {
        $this->content = $content;
    }

    public function isApplied($container) {
        return (strpos($container, (string)$this->content) !== false);
    }
}

class Is implements Rule {
    private $specialNumber;

    public function __construct($specialNumber) {
        $this->specialNumber = $specialNumber;
    }

    public function isApplied($input) {
        return $this->specialNumber == $input;
    }
}

class FizzBuzz {
    private $mappings;

    function __construct($mappings) {
        $this->mappings = $mappings;
    }

    public function calculateFizzBuzz($input) {
        if ($input <= 0) throw new InvalidArgumentException;

        $appliedMappings = $this->getAppliedMappings($input);

        if (count($appliedMappings) == 0) return $input;
        return implode("", array_keys($appliedMappings));
    }

    private function getAppliedMappings($input) {
        $appliedMapping = function ($rules, $name) use ($input) {
            $appliedRule = function ($rule, $index) use ($input) {
                return $rule->isApplied($input);
            };

            return $this->isAny($rules, $appliedRule);
        };

        return $this->filter($this->mappings, $appliedMapping);
    }

    private function filter($inputArray, $callback) {
        $filteredArray = array();

        foreach ($inputArray as $key => $value) {
            if ($callback($value, $key)) {
                $filteredArray[$key] = $value;
            }
        }

        return $filteredArray;
    }

    private function isAny($inputArray, $callback) {
        $filteredArray = $this->filter($inputArray, $callback);

        return count($filteredArray) > 0;
    }
}