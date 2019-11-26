<?php
/**
 * P7Tools\Http\ProtocolTest
 *
 * Testing  HTTP Protocol class
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Http;

class ProtocolTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function setUp() : void
    {

    }

    public function testIfCanGetStatusCodes()
    {
        $protocol = new \P7Tools\Http\Protocol();
        $codes = $protocol->getStatusCodes();
        $codesOnly = $protocol->getStatusCodes(true);
        $this->assertTrue(is_array($codes));
        $this->assertTrue(is_array($codesOnly));
        $numericIndicesOnly = true;
        foreach($codesOnly as $value) {
            if(!is_int($value)) {
                $numericIndicesOnly = false;
            }
        }
        $this->assertTrue($numericIndicesOnly);
    }

    public function testHttpProtocolVersionValues()
    {
        $this->assertEquals(\P7Tools\Http\Protocol::VERSION_10, '1.0');
        $this->assertEquals(\P7Tools\Http\Protocol::VERSION_11, '1.1');
    }

    public function testHttpProtocolMethodValues()
    {
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_OPTIONS, 'OPTIONS');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_GET, 'GET');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_HEAD, 'HEAD');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_POST, 'POST');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_PUT, 'PUT');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_DELETE, 'DELETE');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_TRACE, 'TRACE');
        $this->assertEquals(\P7Tools\Http\Protocol::METHOD_CONNECT, 'CONNECT');
    }

    public function testValidMethod()
    {
        $protocol = new Protocol();
        $this->assertTrue($protocol->isValidMethod('GET'));
    }

    public function testInvalidMethod()
    {
        $protocol = new Protocol();
        $this->assertFalse($protocol->isValidMethod('LOGIN_FOO'));
    }

    public function testMethods()
    {
        $protocol = new Protocol();
        $methods = $protocol->getMethods();
        $this->assertTrue(is_array($methods) && (count($methods) != 0));
        $this->assertTrue(in_array('GET', $methods, true));
    }

}


