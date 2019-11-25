<?php
/**
 * P7Tools\Http\ResponseTest
 *
 * Testing HTTP response
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Http;

class ResponseTest extends \PHPUnit\Framework\TestCase
{

    protected $response;

    public function setUp()
    {
        $this->response = new Response();
        $this->response->init();
    }

    public function testIfBodyIsSetCorrectly()
    {
        $content = 'Payload data';
        $this->response->setBody($content);
        $this->assertTrue($this->response->getBody() == $content);
    }

    public function testIfHeaderIsSetCorrectly()
    {
        $cType = 'text/plain';
        $this->response->setHeader('Content-Type', $cType);
        $this->assertEquals($cType, $this->response->getHeader('Content-Type'));
    }

    public function testIfHeadersAresSetCorrectly()
    {
        $cTypes = array('Content-Type' => 'text/plain');
        $this->response->setHeaders($cTypes);
        $this->assertTrue(is_array($this->response->getHeaders()));
    }

    public function testStatusCode()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->response->setStatusCode(503);
        $this->assertEquals(503, $this->response->getStatusCode());
    }

    public function tearDown()
    {
       // $this->response->sendHeaders();
    }
}


