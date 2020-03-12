<?php declare(strict_types = 1);
/**
 * \P7Tools\Tools\Mock\Context\Http
 *
 * Simulating 'Http context' for e.g. unit testing in CI environment
 *
 * - setting up super globals $_SERVER, $_GET, _POST, tbc.
 *
 *
 * @todo Commenting, changing default values !!
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
     * Cosntructor fucntion - setting fake values for super globals 
     *  - to be used for simulating 'http context'
     *  
     */
    public function __construct()
    {
        $_POST = [];
        global $_PUT;
        $_PUT = [
            'Name' => 'Jean-Pierre',
            'Profession' => 'Capitaine'
        ];
        $_GET = [];
        $_SERVER = [
            'REDIRECT_STATUS' => '200',
            'HTTP_HOST' => 'foo.examl.org',
            'HTTP_USER_AGENT' => 'P7ToolsUserAgent/0.11 (GEOS; CBM; Commodore 128; basic v:7.0) Foo/20200101 Bar/0.023',
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
            'REQUEST_TIME' => '1575485828'
        ];
        $GLOBALS['PUT'] = $_PUT;
    }

    /**
     * Setting {adding to} super global $_GET 
     * 
     * @param array
     * @param bool
     */
    public function setGetVars(array $get, bool $overwrite = false)
    {
        $_GET = ($overwrite) ? array_merge($_GET, $get) : $get;
    }

    /**
     * Setting element of super global $_GET
     *
     * @param string
     * @param string
     */
    public function setGetVar(string $name, string $value)
    {
        $_GET[$name] = $value;
    }
    
    
    /**
     * Setting {adding to} "pseudo super global" $_PUT 
     * 
     * @param array
     * @param bool
     */
    public function setPutVars(array $put, bool $overwrite = false)
    {
        global $_PUT;
        $_PUT = ($overwrite) ? array_merge($_POST, $post) : $post;
        $GLOBALS['PUT'] = $_PUT;
    }

    /**
     * Setting element of "pseudo super global" $_PUT
     *
     * @param string 
     * @param string
     */
    public function setPutVar(string $name, string $value)
    {
        global $_PUT;
        $_PUT[$name] = $value;
        $GLOBALS['PUT'] =$_PUT;
    }

    /**
     * Setting {adding to} super global $_POST
     *
     * @param array
     * @param bool
     */
    public function setPostVars(array $post, bool $overwrite = false)
    {
        $_POST = ($overwrite) ? array_merge($_POST, $post) : $post;
    }

    /**
     * Setting element of super global $_POST
     *
     * @param string
     * @param string
     */
    public function setPostVar(string $name, string $value)
    {
        $_POST[$name] = $value;
    }
    
    /**
     * Setting {adding to} super global $_COOKIE
     *
     * @param array
     * @param bool
     */
    public function setCookieVars(array $cookie, bool $overwrite = false)
    {
        $_COOKIE = ($overwrite) ? array_merge($_COOKIE, $cookie) : $cookie;
    }
    
    /**
     * Setting element of super global $_COOKIE
     *
     * @param string
     * @param string
     */
    public function setCookieVar(string $name, string $value)
    {
        $_COOKIE[$name] = $value;
    }
}
