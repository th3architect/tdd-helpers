<?php

class A extends tad_TestableObject
{

    /**
     * @f functionOne functionTwo
     * @g functionOne functionTwo
     */
    public function methodOne()
    {

    }
}

class B extends tad_TestableObject
{

    /**
     * @f functionOne functionTwo
     * @g functionOne functionTwo
     */
    public function methodOne()
    {

    }

    /**
     * @f functionOne functionTwo
     * @g functionOne functionTwo
     */
    public function methodTwo()
    {

    }
}

class C extends tad_TestableObject
{

    public function methodOne()
    {

    }
}

class D extends tad_TestableObject
{

    /**
     * @f functionOne,functionTwo
     * @g functionOne,functionTwo
     */
    public function methodOne()
    {
    }

    /**
     * @f functionThree, functionFour
     * @g functionThree, functionFour
     */
    public function methodTwo()
    {
    }

    /**
     * @f functionFive;functionSix
     * @g functionFive;functionSix
     */
    public function methodThree()
    {
    }

    /**
     * @f functionSeven; functionEight
     * @g functionSeven; functionEight
     */
    public function methodFour()
    {
    }

    /**
     * @f functionNine functionTen
     * @g functionNine functionTen
     */
    public function methodFive()
    {
    }
}

class E extends tad_TestableObject
{

    /**
     * @Functions functionOne,functionTwo
     * @Globals functionOne,functionTwo
     */
    public function methodOne()
    {
    }

    /**
     * @baz functionThree, functionFour
     * @bar functionThree, functionFour
     */
    public function methodTwo()
    {
    }
}
class F extends tad_TestableObject{

    /**
     * @inject A, B, C
     * @Functions function1, function2
     * @Globals server, post
     */
    public function __construct(){

    }
}
class tad_TestableObjectTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @test
     * it should return a mock functions adapter with mocked methods
     */
    public function it_should_return_a_mock_functions_adapter_with_mocked_methods()
    {
        $fMock = A::getMockFunctions($this);
        $this->assertTrue(method_exists($fMock, '__call'));
        $this->assertTrue(method_exists($fMock, 'functionOne'));
        $this->assertTrue(method_exists($fMock, 'functionTwo'));
    }

    /**
     * @test
     * it should not mock the same functions adapters methods twice
     */
    public function it_should_not_mock_the_same_functions_adapter_methods_twice()
    {
        $fMock = B::getMockFunctions($this);
        $this->assertTrue(method_exists($fMock, '__call'));
        $this->assertTrue(method_exists($fMock, 'functionOne'));
        $this->assertTrue(method_exists($fMock, 'functionTwo'));
    }

    /**
     * @test
     * it should always mock the functions adapter call method
     */
    public function it_should_always_mock_the_functions_adpater_call_method()
    {
        $fMock = C::getMockFunctions($this);
        $this->assertTrue(method_exists($fMock, '__call'));
    }

    /**
     * @test
     * it should deal with different separators for the functions adapter methods
     */
    public function it_should_deal_with_different_separators_for_the_functions_adapter_methods()
    {
        $fMock = D::getMockFunctions($this);
        $this->assertTrue(method_exists($fMock, '__call'));
        $this->assertTrue(method_exists($fMock, 'functionOne'));
        $this->assertTrue(method_exists($fMock, 'functionTwo'));
        $this->assertTrue(method_exists($fMock, 'functionThree'));
        $this->assertTrue(method_exists($fMock, 'functionFour'));
        $this->assertTrue(method_exists($fMock, 'functionFive'));
        $this->assertTrue(method_exists($fMock, 'functionSix'));
        $this->assertTrue(method_exists($fMock, 'functionSeven'));
        $this->assertTrue(method_exists($fMock, 'functionEight'));
        $this->assertTrue(method_exists($fMock, 'functionNine'));
        $this->assertTrue(method_exists($fMock, 'functionTen'));
    }

    /**
     * @test
     * it should return a mock globals adapter with mocked methods
     */
    public function it_should_return_a_mock_globals_adapter_with_mocked_methods()
    {
        $gMock = A::getMockGlobals($this);
        $this->assertTrue(method_exists($gMock, '__call'));
        $this->assertTrue(method_exists($gMock, 'functionOne'));
        $this->assertTrue(method_exists($gMock, 'functionTwo'));
    }

    /**
     * @test
     * it should not mock the same globals adapters methods twice
     */
    public function it_should_not_mock_the_same_globals_adapter_methods_twice()
    {
        $gMock = B::getMockGlobals($this);
        $this->assertTrue(method_exists($gMock, '__call'));
        $this->assertTrue(method_exists($gMock, 'functionOne'));
        $this->assertTrue(method_exists($gMock, 'functionTwo'));
    }

    /**
     * @test
     * it should always mock the globals adapter call method
     */
    public function it_should_always_mock_the_globals_adpater_call_method()
    {
        $gMock = C::getMockGlobals($this);
        $this->assertTrue(method_exists($gMock, '__call'));
    }

    /**
     * @test
     * it should deal with different separators for the globals adapter methods
     */
    public function it_should_deal_with_different_separators_for_the_globals_adapter_methods()
    {
        $gMock = D::getMockGlobals($this);
        $this->assertTrue(method_exists($gMock, '__call'));
        $this->assertTrue(method_exists($gMock, 'functionOne'));
        $this->assertTrue(method_exists($gMock, 'functionTwo'));
        $this->assertTrue(method_exists($gMock, 'functionThree'));
        $this->assertTrue(method_exists($gMock, 'functionFour'));
        $this->assertTrue(method_exists($gMock, 'functionFive'));
        $this->assertTrue(method_exists($gMock, 'functionSix'));
        $this->assertTrue(method_exists($gMock, 'functionSeven'));
        $this->assertTrue(method_exists($gMock, 'functionEight'));
        $this->assertTrue(method_exists($gMock, 'functionNine'));
        $this->assertTrue(method_exists($gMock, 'functionTen'));
    }

    /**
     * @test
     * it should allow getting mock functions adapter for a single method
     */
    public function it_should_allow_getting_mock_functions_adapter_for_a_single_method()
    {
        $mock = D::getMockFunctions($this, 'methodOne');
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertFalse(method_exists($mock, 'functionThree'));
        $this->assertFalse(method_exists($mock, 'functionFour'));
        $this->assertFalse(method_exists($mock, 'functionFive'));
        $this->assertFalse(method_exists($mock, 'functionSix'));
        $this->assertFalse(method_exists($mock, 'functionSeven'));
        $this->assertFalse(method_exists($mock, 'functionEight'));
        $this->assertFalse(method_exists($mock, 'functionNine'));
        $this->assertFalse(method_exists($mock, 'functionTen'));
    }

    /**
     * @test
     * it should allow getting mock globals adapter for a single method
     */
    public function it_should_allow_getting_mock_globals_adapter_for_a_single_method()
    {
        $mock = D::getMockGlobals($this, 'methodOne');
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertFalse(method_exists($mock, 'functionThree'));
        $this->assertFalse(method_exists($mock, 'functionFour'));
        $this->assertFalse(method_exists($mock, 'functionFive'));
        $this->assertFalse(method_exists($mock, 'functionSix'));
        $this->assertFalse(method_exists($mock, 'functionSeven'));
        $this->assertFalse(method_exists($mock, 'functionEight'));
        $this->assertFalse(method_exists($mock, 'functionNine'));
        $this->assertFalse(method_exists($mock, 'functionTen'));
    }

    /**
     * @test
     * it should allow getting mock functions adapter for an array of methods
     */
    public function it_should_allow_getting_mock_functions_adapter_for_an_array_of_methods()
    {
        $mock = D::getMockFunctions($this, array('methodOne', 'methodTwo'));
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertTrue(method_exists($mock, 'functionThree'));
        $this->assertTrue(method_exists($mock, 'functionFour'));
        $this->assertFalse(method_exists($mock, 'functionFive'));
        $this->assertFalse(method_exists($mock, 'functionSix'));
        $this->assertFalse(method_exists($mock, 'functionSeven'));
        $this->assertFalse(method_exists($mock, 'functionEight'));
        $this->assertFalse(method_exists($mock, 'functionNine'));
        $this->assertFalse(method_exists($mock, 'functionTen'));
    }

    /**
     * @test
     * it should allow getting mock globals adapter for an array of methods
     */
    public function it_should_allow_getting_mock_globals_adapter_for_an_array_of_methods()
    {
        $mock = D::getMockGlobals($this, array('methodOne', 'methodTwo'));
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertTrue(method_exists($mock, 'functionThree'));
        $this->assertTrue(method_exists($mock, 'functionFour'));
        $this->assertFalse(method_exists($mock, 'functionFive'));
        $this->assertFalse(method_exists($mock, 'functionSix'));
        $this->assertFalse(method_exists($mock, 'functionSeven'));
        $this->assertFalse(method_exists($mock, 'functionEight'));
        $this->assertFalse(method_exists($mock, 'functionNine'));
        $this->assertFalse(method_exists($mock, 'functionTen'));
    }

    /**
     * @test
     * it should allow specifying the notation for the functions adapter
     */
    public function it_should_allow_specifying_the_notation_for_the_functions_adapter()
    {
        $mock = E::getMockFunctions($this, 'methodOne', 'Functions');
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
    }
    /**
     * @test
     * it should allow specifying the notation for the globals adapter
     */
    public function it_should_allow_specifying_the_notation_for_the_globals_adapter()
    {
        $mock = E::getMockFunctions($this, 'methodOne', 'Globals');
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
    }

    /**
     * @test
     * it should allow specifying an array of notations for the functions adapter
     */
    public function it_should_allow_specifying_an_array_of_notations_for_the_functions_adapter()
    {
        $mock = E::getMockFunctions($this, null, array('Functions', 'baz'));
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertTrue(method_exists($mock, 'functionThree'));
        $this->assertTrue(method_exists($mock, 'functionFour'));
    }

    /**
     * @test
     * it should allow specifying an array of notations for the globals adapter
     */
    public function it_should_allow_specifying_an_array_of_notations_for_the_globals_adapter()
    {
        $mock = E::getMockGlobals($this, null, array('Globals', 'bar'));
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
        $this->assertTrue(method_exists($mock, 'functionThree'));
        $this->assertTrue(method_exists($mock, 'functionFour'));
    }

    /**
     * @test
     * it should return a tad_MockObject instance when calling getMockFunctionsBuilder method
     */
    public function it_should_return_a_tad_mock_object_instance_when_calling_get_mock_functions_builder_method()
    {
        $this->assertInstanceOf('tad_MockObject', E::getMockFunctionsBuilder($this));
    }

    /**
     * @test
     * it should return a tad_MockObject instance when calling the getMockGlobalsBuilder method
     */
    public function it_should_return_a_tad_mock_object_instance_when_calling_the_get_mock_globals_builder_method()
    {
        $this->assertInstanceOf('tad_MockObject', E::getMockGlobalsBuilder($this));
    }


    /**
     * @test
     * it should allow using fluent interface to build functions adapter mocks
     */
    public function it_should_allow_using_fluent_interface_to_build_functions_adapter_mocks()
    {
        $mock = E::getMockFunctionsBuilder($this)
            ->forMethods('methodOne')
            ->setNotation(array('Functions', 'baz'))
            ->getMock();
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
    }

    /**
     * @test
     * it should allow using fluent interface to build globals adapter mocks
     */
    public function it_should_allow_using_fluent_interface_to_build_globals_adapter_mocks()
    {
        $mock = E::getMockGlobalsBuilder($this)
            ->forMethods('methodOne')
            ->setNotation(array('Functions', 'baz'))
            ->getMock();
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'functionOne'));
        $this->assertTrue(method_exists($mock, 'functionTwo'));
    }

    /**
     * @test
     * it should allow mocking constructor functions adapter dependency
     */
    public function it_should_allow_mockin_constructor_functions_adapter_dependency()
    {
        $mock = F::getMockFunctionsBuilder($this)
            ->forMethods('__construct')
            ->setNotation('Functions')
            ->setMethods('__call')
            ->getMock();
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'function1'));
        $this->assertTrue(method_exists($mock, 'function2'));
    }

    /**
     * @test
     * it should allow mocking constructor globals adapter dependencies
     */
    public function it_should_allow_mocking_constructor_globals_adapter_dependencies()
    {
        $mock = F::getMockGlobalsBuilder($this)
            ->forMethods('__construct')
            ->setNotation('Globals')
            ->setMethods('__call')
            ->getMock();
        $this->assertTrue(method_exists($mock, '__call'));
        $this->assertTrue(method_exists($mock, 'server'));
        $this->assertTrue(method_exists($mock, 'post'));
    }
}