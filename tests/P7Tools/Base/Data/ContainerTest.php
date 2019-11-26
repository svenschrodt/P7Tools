<?php
/**
 * P7Tools\Base\Data\ContainerTest
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */

use PHPUnit\Framework\TestCase; 
use P7Tools\Base\Data\Container;

class ContainerTest extends TestCase
{

    protected $testContainer;

    public function setUp() : void
    {
        // $_SERVER['QUERY_STRING'] = 'a=00&b=n';
        \P7Tools\Dev\Mock::setSuperGlobal();
        $this->testContainer = new Container();
    }    

    public function testCanBeConstructedFromUppercaseString()
    {
        $c = new Container();
        $this->assertInstanceOf('P7Tools\Base\Data\Container', $c);
        $this->assertFalse(2==1.5);
        return $c;
    }

    public function testMagicalGetterAndSetter()
    {
        $name = 'Thor';
        $this->testContainer->name = $name;
        $this->assertEquals($name, $this->testContainer->name);
        $this->assertTrue(isset($this->testContainer->name));
    }


    public function testMagicalIssetAndUnset()
    {
        $name = 'Thor';
        $this->testContainer->name = $name;
        $this->assertEquals($name, $this->testContainer->name);
        $this->assertTrue(isset($this->testContainer->name));
        unset($this->testContainer->name);
        $this->assertFalse(isset($this->testContainer->name));
    }


    public function testIfTraversable()
    {
        $testContainer = new Container();
        $testContainer->name = 'Thor';
        $testContainer->otherName = 'Dr. Don Blake';
        $testArray = array();
        foreach ($testContainer as $item) {
            $testArray[] = $item;
        }
        $this->assertTrue(count($testArray) == 2);
    }

    public function testIfPropertyKeysAreSetCorrectly()
    {
        $testContainer = new Container();
        $heroName = 'Thor';
        $privateName = 'Dr. Don Blake';
        $testContainer->name = $heroName;
        $testContainer->otherName = $privateName;
        $testArray = $testContainer->getExistingKeys();
        $this->assertTrue($testArray[1] == 'otherName');
        $this->assertTrue($testArray[0] == 'name');
    }

    public function testIfPropertyValuesAreSetCorrectly()
    {
        $testContainer = new Container();
        $heroName = 'Thor';
        $privateName = 'Dr. Don Blake';
        $testContainer->name = $heroName;
        $testContainer->otherName = $privateName;
        $testArray = $testContainer->getExistingKeys();
        $this->assertTrue($testContainer->name == $heroName);
        $this->assertTrue($testContainer->otherName == $privateName);
    }

    public function testIfKeyIsValid()
    {
        $testContainer = new Container();
        $this->assertTrue($testContainer->isValidKey('foo'));
    }

    public function testIfSetKeyIsValid()
    {
        $testContainer = new Container();
        $testContainer->setValidKeys(array('fooBar'));
        $this->assertTrue($testContainer->isValidKey('fooBar'));
    }

    public function testNotSetKeyIsInvalid()
    {
        $testContainer = new Container();
        $testContainer->setValidKeys(array('fooBar'));
        $this->assertFalse($testContainer->isValidKey('mee'));
    }

    public function testSetterAndGetterFunction()
    {
        $name = 'Paul';
        $testContainer = new Container();
        $testContainer->setFirstName($name);
        $this->assertEquals($name, $testContainer->getFirstName());
        $this->assertEquals($testContainer->firstName, $name);
        $this->assertEquals($testContainer->firstName, $testContainer->getFirstName());
    }

    public function testIfSerializingAndUnSerializingWorksCorrectly()
    {
        $testContainer = new Container();
        $test = (string)$testContainer;
        $test2 = unserialize($test);
        $this->assertTrue($testContainer == $test2);
    }

    public function testIfImportAndExportMethodsWork()
    {
        $testContainer = new Container();
        $testContainer->name = 'Thor';
        $testContainer->otherName = 'Dr. Don Blake';
        $testContainer->setValidKeys(array('name', 'otherName', 'homeLand'));
        $testContainer->setHomeLand('Asgard');
        $test = $testContainer->exportInstance();
        $newContainer = new Container();
        $newContainer->importInstance($test);
        $this->assertTrue($newContainer == $testContainer);
        $this->assertTrue(isset($testContainer->homeLand));
        $this->assertEquals("Asgard", $testContainer->homeLand);
    }
}


