<?php declare(strict_types=1);
/**
 * P7Tools\Http\Request
 *
 * Class to manage HTTP requests 
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Http;


class Request extends \P7Tools\Base\Data\Container
{
    /**
     * Meta information from http context
     * 
     * @var array
     */
    protected $_data = array();
   
    /**
     * Generic costructor function
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Getting meta information from http context
     * 
     * @todo Do more commenting 
     */
    protected function init()
    {

        $this->_data = array(

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
        $this->_data['url'] = (strstr($_SERVER['REQUEST_URI'], '?')) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?') ): $_SERVER['REQUEST_URI'];
        list($this->_data['scheme'], $this->_data['version']) = explode('/', $this->_data['protocol']);
    }


    /**
     * @deprecated
     * @TODO Using fucntionality of \P7Tools\Mvc\Router
     * @param bool $url
     * @return array
     */
    public function getUrlParts(bool $url = false)
    {
        if (!$url) {
            $url = $this->url;
        }
        $parts = explode('/', $url);
        array_shift($parts);
        return $parts;
    }

}