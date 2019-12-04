<?php declare(strict_types = 1);
/**
 *  \P7Tools\Tools\Mock\Context\Http
 * 
 * Simulating 'Http context' for e.g. unit testing in CI environment 
 * 
 * - setting up super globals $_SERVER, $_GET, _POST, tbc.
 *  
 *
 * @todo Commenting !!
 *      
 *       !Do not use in production until it is stable!
 *      
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 04.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Tools\Mock\Context;

class Http
{
    /**
     * Setting 
     */
   public function __construct()
   {

       $_SERVER = [
           'REDIRECT_STATUS' => '200',
           'HTTP_HOST' => 'foo.examl.org',
           'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:70.0) Gecko/20100101 Firefox/70.0',
           'HTTP_ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
           'HTTP_ACCEPT_LANGUAGE' => 'de,en-US;q=0.7,en;q=0.3',
           'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
           'HTTP_REFERER' => 'http://localhost/P7Tools/post.html',
           'HTTP_CONNECTION' => 'keep-alive',
           'HTTP_UPGRADE_INSECURE_REQUESTS' => '1',
           'HTTP_CACHE_CONTROL' => 'max-age=0',
           'PATH' => '/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin',
           'SERVER_SIGNATURE' => 'P7Tools/0.1.29 (Foo) Server at localhost Port 443',
           'SERVER_SOFTWARE' => 'P7Tools/0.1.29 (Foo) ',
           'SERVER_NAME' => 'localhost',
           'SERVER_ADDR' => '127.0.0.1',
           'SERVER_PORT' => '443',
           'REMOTE_ADDR' => '127.0.0.1',
           'DOCUMENT_ROOT' => '/var/www/html',
           'REQUEST_SCHEME' => 'http',
           'CONTEXT_PREFIX' => '',
           'CONTEXT_DOCUMENT_ROOT' => '/var/www/html',
           'SERVER_ADMIN' => 'jean-pierre@schlummerpiraten.example.org',
           'SCRIPT_FILENAME' => '/var/www/html/P7Tools/index.php',
           'REMOTE_PORT' => '50916',
           'REDIRECT_URL' => '/P7Tools/Foo/BAr/Foo/99/',
           'REDIRECT_QUERY_STRING' => 'firstname=Mickey&Uploadable%5B%5D=ikr.txt&Uploadable%5B%5D=parse_266.php&lastname=Mouse',
           'GATEWAY_INTERFACE' => 'CGI/1.1',
           'SERVER_PROTOCOL' => 'HTTP/1.1',
           'REQUEST_METHOD' => 'GET',
           'QUERY_STRING' => 'firstname=23Mickey&Uploadable%5B%5D=ikr.txt&Uploadable%5B%5D=parse_266.php&lastname=Mouse',
           'REQUEST_URI' => '/P7Tools/Foo/BAr/Foo/99/?firstname=Mickey&Uploadable%5B%5D=ikr.txt&Uploadable%5B%5D=parse_266.php&lastname=Mouse',
           'SCRIPT_NAME' => '/P7Tools/index.php',
           'PHP_SELF' => '/P7Tools/index.php',
           'REQUEST_TIME_FLOAT' => '1575485828.746',
           'REQUEST_TIME' => '1575485828'];
    
   }
   
   public function  setGetVars(array $post)
   {
       
   }
   
   public function  setPutVars(array $post)
   {
       
   }
   public function  setPostVars(array $post)
   {
       
   }
   public function  setCookieVars(array $post)
   {
       
   }
}
