<?php

class PHPUnitExtendedTestCase extends PHPUnit_Framework_TestCase {
    protected function assertFunctionIO($function, $inputArguments, $outputNumber)
    {
        $this->assertEquals($outputNumber, call_user_func_array($function, $inputArguments));
    }

    protected function assertThrowsException($function, $inputArguments, $failureMessage)
    {
        $throwedException = false;
        try {
            call_user_func_array($function, $inputArguments);
        } catch (InvalidArgumentException $e) {
            $throwedException = true;
        }

        $this->assertTrue($throwedException, $failureMessage);
    }

    protected function assertOutputOfValues($function, $inputArgumentsArray, $outputValue)
    {
        array_map(
            function ($input) use ($function, $outputValue) {
                $this->assertFunctionIO($function, $input, $outputValue);
            },
            $inputArgumentsArray
        );
    }
}