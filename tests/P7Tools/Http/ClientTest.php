<?php
/**
 * P7Tools\Http\CooperationTest
 *
 * Testing co operating of HTTP components
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Http;

use P7Tools\Base\File\Exception;
use P7Tools\Dev\Helper;

class ClientTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    protected $curlClient;
    
    public function testFooBar()
    {
        $this->assertFalse(3==='3');
    }

//     public function setUp()
//     {
//         $this->curlClient = new CurlClient();
//     }

    public function NOtestFileExceptionEtc()
    {
//         Helper::getInfo(false);
//         Helper::printInfo(true);
        $this->setExpectedException('\P7Tools\Base\File\Exception');
        throw new \P7Tools\Base\File\Exception('foo');

    }



//    public function testIfCanConnectToHttp()
//    {
//        $client = new \P7Tools\Http\Client('http://www.example.net/');
//        $client->connect();
//        $message = $client->get();
//        $this->assertEquals('\P7Tools\Http\Response', $message);
//
//    }

    public function tearDown()
    {
        // $this->response->sendHeaders();
    }
}


