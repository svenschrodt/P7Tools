<?php
/**
 * P7Tools\Http\ClientTest
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
namespace P7Tools\Net;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function testBar()
    {
        $this->assertTrue(!false);
    }

    public function NOtestIfCanConnectToHostAtPortHttp()
    {
        $host = 'localhost';
        $client = new \P7Tools\Net\Client();
        $client->host= $host;
        $client->port = "80";
        $client->connect();
//         //}
     $in = "GET / HTTP/1.1\r\n";
        $in .= "Host: $host\r\n";
        $in .= "Connection: Close\r\n\r\n";
        $client->write($in);
        //$client->write("test\n");
        $result =  $client->read();
        $a = \P7Tools\Http\Parser::splitMessage($result);
        //echo gettype($client->socket);
        $b = \P7Tools\Http\Parser::splitHeaders($a[0]);
        var_dump($b);
        //$this->assertTrue(is_String($client->read()));
    }


}


