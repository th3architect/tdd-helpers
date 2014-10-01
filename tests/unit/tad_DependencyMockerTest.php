<?php
namespace some\vendor {

    class Test231 extends \tad_TestableObject
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

}
namespace {

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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods('__construct')
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods('methodOne')
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods('methodTwo')
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods('methodThree')
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods('methodThree')
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods(array('methodTwo', 'methodThree'))
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods(array('methodTwo', 'methodThree'))
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
            $sut = new tad_DependencyMocker('Test231');
            $mockDeps = $sut->forMethods(array('methodTwo', 'methodThree'))
                ->getMocksArray();
            extract($mockDeps);
            $this->assertNotNull($Test119);
            $this->assertNotNull($Interface119);
            $this->assertNotNull($Interface120);
        }

        /**
         * @test
         * it should allow mocking namespaced classes
         */
        public function it_should_allow_mocking_namespaced_classes()
        {
            $sut = new tad_DependencyMocker('\some\vendor\Test231');
            $mockDeps = $sut->forMethods(array('methodTwo', 'methodThree'))
                ->getMocksArray();
            extract($mockDeps);
            $this->assertNotNull($Test119);
            $this->assertNotNull($Interface119);
            $this->assertNotNull($Interface120);
        }

        /**
         * @test
         * it should allow getting an instance of the class using the on static method
         */
        public
        function it_should_allow_getting_an_instance_of_the_class_using_the_on_static_method()
        {
            $this->assertInstanceOf('tad_DependencyMocker', \tad_DependencyMocker::on('stdClass'));
        }

        /**
         * @test
         * it should allow mocking the constructor method by defatult if no methods are set
         */
        public function it_should_allow_mocking_the_constructor_method_by_defatult_if_no_methods_are_set()
        {
            $sut = new tad_DependencyMocker('\some\vendor\Test231');
            $mockDeps = $sut->getMocksArray();
            extract($mockDeps);
            $this->assertNotNull($Test119);
            $this->assertFalse(isset($Interface119));
            $this->assertNotNull($Interface120);
        }

        /**
         * @test
         * it should allow stubbin non-existing methods explicitly
         */
        public function it_should_allow_stubbin_non_existing_methods_explicitly()
        {
            $toStub = [
                'Interface119' => ['one', 'two', 'three']
            ];
            $sut = new \tad_DependencyMocker('\some\vendor\Test231');
            extract($sut->forMethods('methodTwo')->stub($toStub)->getMocksArray());
            $this->assertNotNull($Test119);
            $this->assertNotNull($Interface119);
            $this->assertTrue(method_exists($Interface119, '__call'));
            $this->assertTrue(method_exists($Interface119, 'one'));
            $this->assertTrue(method_exists($Interface119, 'two'));
            $this->assertTrue(method_exists($Interface119, 'three'));
        }
    }
}
