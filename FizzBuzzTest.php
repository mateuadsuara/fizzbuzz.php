<?php

include "PHPUnitExtendedTestCase.php";
include "FizzBuzz.php";

class FizzBuzzTest extends PHPUnitExtendedTestCase {
    /**
     * @var FizzBuzz
     */
    private $fizzBuzz;

    private $calculateFizzBuzz;

    public function setUp(){
        $this->fizzBuzz = new FizzBuzz();
        $this->calculateFizzBuzz = function ($input) {
            return $this->fizzBuzz->calculateFizzBuzz($input);
        };
    }

    public function test_returnSameNumber(){
        array_map(
            function($input){
                $this->assertFunctionIO($this->calculateFizzBuzz, [$input], $input);
            },
            [1, 2, 4]
        );
    }

    public function test_whenInputIsInvalid_throwsException(){
        array_map(
            function($inputArguments){
                $inputStr = implode(", ", $inputArguments);
                $this->assertThrowsException($this->calculateFizzBuzz, $inputArguments, "Expected InvalidArgumentException for input $inputStr!");
            },
            [[0], [-1], ["asdf"]]
        );
    }

    private function assertCalculate ($inputs, $output){
        $argumentsArray = array_map(
            function($input){
               return [$input];
            },
            $inputs
        );
        $this->assertOutputOfValues($this->calculateFizzBuzz, $argumentsArray, $output);
    }

    public function test_returnFizzNumbers(){
        $this->assertCalculate([3, 6, 9, 13], "Fizz");
    }

    public function test_returnBuzzNumbers(){
        $this->assertCalculate( [5, 10, 52], "Buzz");
    }

    public function test_returnBazzNumbers(){
        $this->assertCalculate( [7, 14, 71], "Bazz");
    }

    public function test_returnFizzBuzzNumbers(){
        $this->assertCalculate( [15, 45, 51], "FizzBuzz");
    }

    public function test_returnFizzBuzzBazzNumbers(){
        $this->assertCalculate( [105, 952], "FizzBuzzBazz");
    }
}
 