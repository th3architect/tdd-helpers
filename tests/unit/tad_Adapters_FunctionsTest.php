<?php

class tad_Adapters_FunctionsTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

        /**
         * @test
         * it should be instantiatable using autoload
         */
        public function it_should_be_instantiatable_using_autoload()
        {
            $class = 'tad_Adapters_Functions';
            $this->assertInstanceOf($class, new $class);
        }
}