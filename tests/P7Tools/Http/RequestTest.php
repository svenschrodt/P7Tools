<?php
/**
 * P7Tools\Http\RequestTest
 *
 * Testing HTTP request
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
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

    public function testIfGivenUrlIsParsedCorrectly()
    {
        $parts = $this->request->getUrlParts('/foo/bar/Baz=99');
        $this->assertEquals('foo', $parts[0]);
    }

    public function testIfDefaultUrlIsParsedCorrectly()
    {
        $parts = $this->request->getUrlParts();
        $this->assertEquals('Baz', $parts[2]);
    }

}


