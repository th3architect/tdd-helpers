<?php

interface Interface119
{
    public function __call($name, $args);
}

interface Interface120
{
    public function someMethod();
}

class Test119 extends tad_TestableObject
{

    /**
     * @Functions functionOne,functionTwo
     */
    public function methodOne()
    {
    }

    /**
     * @baz functionThree, functionFour
     */
    public function methodTwo()
    {
    }

    /**
     * @baz functionFive, functionSix
     */
    public function methodThree()
    {
    }
}

class Test231 extends tad_TestableObject
{

    /**
     * @depends Test119, Interface120
     */
    public function __construct()
    {
    }

    /**
     * @depends Test119, Interface120
     */
    public function methodOne()
    {

    }

    /**
     * @depends Test119, Interface119
     */
    public function methodTwo()
    {

    }

    /**
     * @depends Test119, Interface120
     */
    public function methodThree(Test119 $test119, Interface120 $interface120)
    {
        return $test119->methodOne() + $interface120->someMethod();

    }

}

class tad_DependencyMockerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * it should allow getting an array of all mocked constructor dependencies
     */
    public function it_should_allow_getting_an_array_of_all_mocked_constructor_dependencies()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods('__construct')
            ->getMocks();
        $this->assertObjectHasAttribute('Test119', $mockDeps);
        $this->assertObjectHasAttribute('Interface120', $mockDeps);
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodOne'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodTwo'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodThree'));
        $this->assertTrue(method_exists($mockDeps->Interface120, 'someMethod'));
    }

    /**
     * @test
     * it should allow getting an array of all mocked method dependencies
     */
    public function it_should_allow_getting_an_array_of_all_mocked_method_dependencies()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods('methodOne')
            ->getMocks();
        $this->assertObjectHasAttribute('Test119', $mockDeps);
        $this->assertObjectHasAttribute('Interface120', $mockDeps);
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodOne'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodTwo'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodThree'));
        $this->assertTrue(method_exists($mockDeps->Interface120, 'someMethod'));
    }

    /**
     * @test
     * it should allow mocking interface dependencies with magic methods
     */
    public function it_should_allow_mocking_interface_dependencies_with_magic_methods()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods('methodTwo')
            ->getMocks();
        $this->assertObjectHasAttribute('Test119', $mockDeps);
        $this->assertObjectHasAttribute('Interface119', $mockDeps);
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodOne'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodTwo'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodThree'));
        $this->assertTrue(method_exists($mockDeps->Interface119, '__call'));
    }

    /**
     * @test
     * it should allow setting expectations on returned methods
     */
    public function it_should_allow_setting_expectations_on_returned_methods()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods('methodThree')
            ->getMocks();
        $mockDeps->Test119->expects($this->once())
            ->method('methodOne');
        $mockDeps->Interface120->expects($this->once())
            ->method('someMethod');
        $test231 = new Test231();
        $test231->methodThree($mockDeps->Test119, $mockDeps->Interface120);
    }

    /**
     * @test
     * it should allow setting return values on returned methods
     */
    public function it_should_allow_setting_return_values_on_returned_methods()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods('methodThree')
            ->getMocks();
        $mockDeps->Test119->expects($this->once())
            ->method('methodOne')
            ->will($this->returnValue(4));
        $mockDeps->Interface120->expects($this->once())
            ->method('someMethod')
            ->will($this->returnValue(5));
        $test231 = new Test231();
        $this->assertEquals(9, $test231->methodThree($mockDeps->Test119, $mockDeps->Interface120));
    }

    /**
     * @test
     * it should allow mocking dependencies for multiple methods passing an array
     */
    public function it_should_allow_mocking_dependencies_for_multiple_methods_passing_an_array()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods(array('methodTwo', 'methodThree'))
            ->getMocks();
        $this->assertObjectHasAttribute('Test119', $mockDeps);
        $this->assertObjectHasAttribute('Interface119', $mockDeps);
        $this->assertObjectHasAttribute('Interface120', $mockDeps);
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodOne'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodTwo'));
        $this->assertTrue(method_exists($mockDeps->Test119, 'methodThree'));
        $this->assertTrue(method_exists($mockDeps->Interface119, '__call'));
        $this->assertTrue(method_exists($mockDeps->Interface120, 'someMethod'));
    }

    /**
     * @test
     * it should allow getting an array of mocked dependencies
     */
    public function it_should_allow_getting_an_array_of_mocked_dependencies()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods(array('methodTwo', 'methodThree'))
            ->getMocksArray();
        $this->assertArrayHasKey('Test119', $mockDeps);
        $this->assertArrayHasKey('Interface119', $mockDeps);
        $this->assertArrayHasKey('Interface120', $mockDeps);
        $this->assertTrue(method_exists($mockDeps['Test119'], 'methodOne'));
        $this->assertTrue(method_exists($mockDeps['Test119'], 'methodTwo'));
        $this->assertTrue(method_exists($mockDeps['Test119'], 'methodThree'));
        $this->assertTrue(method_exists($mockDeps['Interface119'], '__call'));
        $this->assertTrue(method_exists($mockDeps['Interface120'], 'someMethod'));
    }

    /**
     * @test
     * it should allow extracting mocked dependencies
     */
    public function it_should_allow_extracting_mocked_dependencies()
    {
        $sut = new tad_DependencyMocker($this, 'Test231');
        $mockDeps = $sut->setMethods(array('methodTwo', 'methodThree'))
            ->getMocksArray();
        extract($mockDeps);
        $this->assertNotNull($Test119);
        $this->assertNotNull($Interface119);
        $this->assertNotNull($Interface120);
    }
}