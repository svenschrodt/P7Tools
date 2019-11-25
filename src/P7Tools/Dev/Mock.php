<?php declare(strict_types=1);
/**
 * P7Tools\Dev\Mock
 *
 * Mocking objects | data types -> e.g: for Unit testing
 * super globals in non-HTTP context
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Dev;


//TODO -> make this a better place
class Mock
{


    public static function setSuperGlobal($superGlobal = '$_SERVER')
    {
        switch ($superGlobal) {

            case '$_SERVER':
            default:
                $_SERVER['QUERY_STRING'] = 'a=00&b=n';
                $_SERVER['REQUEST_URI'] = '/Test/bar/Baz/999?node=Fnord23';
                $_SERVER['REQUEST_METHOD'] = 'GET';
                $_SERVER['SERVER_PORT'] = 80 ;
                $_SERVER['SERVER_NAME'] = 'Thanos';
                $_SERVER['SERVER_SOFTWARE'] = '     **** COMMODORE BASIC 64 V2 ****';
                $_SERVER['SERVER_SIGNATURE'] = '.../Psst-3.4223666';
                $_SERVER['SERVER_ADDR'] = '0.6.6.6';
                $_SERVER['SERVER_PROTOCOL'] = 'FN0RD 2.3';
                $_SERVER['REMOTE_PORT'] = '42666';
                $_SERVER['HTTP_HOST'] = 'Norrin Radd';
                $_SERVER['REMOTE_ADDR'] = '1.2.4.2';
                $_SERVER['HTTP_USER_AGENT'] = 'Multiplan 1.0';
                $_SERVER['HTTP_ACCEPT'] = 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
                $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'de,en-US;q=0.7,en;q=0.3';
                $_SERVER['HTTP_ACCEPT_ENCODING'] = 'gzip, deflate';
                $_SERVER['HTTP_CONNECTION'] = 'keep-alive';
                $_SERVER['SERVER_PROTOCOL'] = 'HTTP/2.3';

        }
    }
} 