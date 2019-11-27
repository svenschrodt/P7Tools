<?php
/**
 * P7Tools\Http\RequestTest
 *
 * Testing HTTP request
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @link https://travis-ci.org/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Http;

class RequestTest extends \PHPUnit\Framework\TestCase
{

    protected $request;

    public function setUp() : void
    {
        \P7Tools\Dev\Mock::setSuperGlobal();
        $this->request = new Request();

    }

    public function testFoo()
    {
        $this->assertTrue(2*2==4);    
    }
    
    public function NOtestIfGivenUrlIsParsedCorrectly()
    {
        $parts = $this->request->getUrlParts('/foo/bar/Baz=99');
        $this->assertEquals('foo', $parts[0]);
    }

    public function NOtestIfDefaultUrlIsParsedCorrectly()
    {
        $parts = $this->request->getUrlParts();
        $this->assertEquals('Baz', $parts[2]);
    }

}


