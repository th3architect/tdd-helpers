<?php

/**
 * Class tad_DependencyMocker
 *
 * Mocks method dependencies. The supposed workflow is
 *
 *     $mocker = new tad_DependencyMocker($this, $className);
 *     $mockedDependencies = $mocker->forMethods(array('methodOne, methodTwo));
 *
 *     // set expectations and return values on mocked objects
 *     $mockedDependencies->DependencyOne->expects(...
 */
class tad_DependencyMocker
{
    protected $className;
    protected $methodName;
    protected $notation;

    /**
     * @param PHPUnit_Framework_TestCase $testCase
     * @param $className
     */
    public function __construct($className)
    {
        if (!is_string($className)) {
            throw new InvalidArgumentException('Class name must be a string', 1);
        }
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Class $className does not exisit", 2);
        }
        $this->className = $className;
    }

    /**
     * Sets the notation to be used to pick up a method dependencies.
     *
     * By default the "depends" notation will be used.
     *
     * @param $notation
     * @return $this
     */
    public function setNotation($notation)
    {
        $this->notation = $notation;
        return $this;
    }

    /**
     * Returns an object defining each mocked dependency as a property.
     *
     * The property name is the same as the mocked class name.
     *
     * @return stdClass
     */
    public function getMocks()
    {
        return $this->getMocksObjectOrArray(true);
    }

    /**
     * Returns an array containing the mocked dependencies.
     *
     * The array format is ['ClassName' => mock].
     *
     * @return array
     */
    public function getMocksArray()
    {
        return $this->getMocksObjectOrArray(false);
    }

    /**
     * Sets one or more methods to be mocked.
     *
     * @param $methodNameOrArray
     * @return $this
     */
    public function forMethods($methodNameOrArray)
    {
        if (!is_string($methodNameOrArray) && !is_array($methodNameOrArray)) {
            throw new InvalidArgumentException('Method name must be a string or an array', 1);
        }
        $this->methodName = $methodNameOrArray;
        return $this;
    }

    /**
     * @return stdClass/array
     */
    protected function getMocksObjectOrArray($getObject = true)
    {
        $notation = $this->notation ? '@' . $this->notation : '@depends';
        if (!isset($this->methodName)) {
            $methods = array('__construct');
        } else {
            $methods = is_array($this->methodName) ? $this->methodName : array($this->methodName);
        }
        $mockables = array();
        foreach ($methods as $method) {
            $reflector = new ReflectionMethod($this->className, $method);
            $docBlock = $reflector->getDocComment();
            $lines = explode("\n", $docBlock);
            foreach ($lines as $line) {
                if (count($parts = explode($notation, $line)) > 1) {
                    $classes = trim(preg_replace("/[,;(; )(, )]+/", " ", $parts[1]));
                    $classes = explode(' ', $classes);
                    foreach ($classes as $class) {
                        $mockables[] = $class;
                    }
                }
            }
        }
        $testCase = new tad_SpoofTestCase();
        if ($getObject) {
            $mocks = new stdClass();
            foreach ($mockables as $mockable) {
                $mocks->$mockable = $testCase->getMockBuilder($mockable)->disableOriginalConstructor()->getMock();
            }
        } else {
            $mocks = array();
            foreach ($mockables as $mockable) {
                $mocks[$mockable] = $testCase->getMockBuilder($mockable)->disableOriginalConstructor()->getMock();
            }
        }
        return $mocks;
    }

    /**
     * Static constructor method for the class.
     *
     * @param $className
     * @return tad_DependencyMocker
     */
    public static function on($className)
    {
        return new self($className);
    }
}

/**
 * Class tad_SpoofTestCase
 *
 * Just an extension of the PHPUnit_Framework_TestCase class
 * to allow for method mocks creation.
 */
class tad_SpoofTestCase extends PHPUnit_Framework_TestCase
{

}