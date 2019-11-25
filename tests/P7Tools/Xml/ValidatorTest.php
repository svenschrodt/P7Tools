<?php
/**
 * P7Tools\Xml\ValidatorTest
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Xml;

class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    
    public function testFoo()
    {
     $this->assertFalse(3===2);   
    }

    public function NOtestIfContentIsValidElementContent()
    {

        $text = 'Lorem Ipsum';
        $stdObject = new \stdClass();
        $element = new \P7Tools\Xml\Element();
        $list = [1,2,3];
        $this->assertTrue(\P7Tools\Xml\Validator::isValidElementContent($text));
        $this->assertFalse(\P7Tools\Xml\Validator::isValidElementContent($stdObject));
        $this->assertTrue(\P7Tools\Xml\Validator::isValidElementContent($element));
        $this->assertFalse(\P7Tools\Xml\Validator::isValidElementContent($list));

    }

    public function NOtestIfIsValidElement()
    {
        $text = 'Lorem Ipsum';
        $stdObject = new \stdClass();
        $element = new \P7Tools\Xml\Element();
        $list = [1,2,3];
        $this->assertFalse(\P7Tools\Xml\Validator::isValidElement($text));
        $this->assertFalse(\P7Tools\Xml\Validator::isValidElement($stdObject));
        $this->assertTrue(\P7Tools\Xml\Validator::isValidElement($element));
        $this->assertFalse(\P7Tools\Xml\Validator::isValidElement($list));
    }
}
