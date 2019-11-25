<?php declare(strict_types=1);
/**
 * P7Tools\Http\Request
 *
 * Class to manage HTTP requests in context of Web MVC application
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
namespace P7Tools\Http;


class Request extends \P7Tools\Base\Data\Container
{


    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {

        $this->data = array(

            'queryString' => $_SERVER['QUERY_STRING'],
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD'],
            'serverPort' => $_SERVER['SERVER_PORT'],
            'serverName' => $_SERVER['SERVER_NAME'],
            'serverSoftware' => $_SERVER['SERVER_SOFTWARE'],
            'serverAddress' => $_SERVER['SERVER_ADDR'],
            'protocol' => $_SERVER['SERVER_PROTOCOL'],
            'remotePort' => $_SERVER['REMOTE_PORT'],
            'remoteHost' => $_SERVER['HTTP_HOST'],
            'remoteAddress' => $_SERVER['REMOTE_ADDR'],
            'userAgent' => $_SERVER['HTTP_USER_AGENT'],
            'accept' => $_SERVER['HTTP_ACCEPT'],
            'acceptLanguage' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'acceptEncoding' => $_SERVER['HTTP_ACCEPT_ENCODING'],
            'connection' => $_SERVER['HTTP_CONNECTION']
        );
        // extract URL from URI if needed
        $this->data['url'] = (strstr($_SERVER['REQUEST_URI'], '?')) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?') ): $_SERVER['REQUEST_URI'];
        list($this->data['scheme'], $this->data['version']) = explode('/', $this->data['protocol']);
    }


    /**
     * @param bool $url
     * @return array
     */
    public function getUrlParts($url = false)
    {
        if (!$url) {
            $url = $this->url;
        }
        $parts = explode('/', $url);
        array_shift($parts);
        return $parts;
    }

}