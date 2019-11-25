<?php declare(strict_types=1);
/**
 * P7Tools\Http\Client
 *
 * Simple HTTP client
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


class Client extends \P7Tools\Net\Client
{

    /**
     * URI for current HTTP Communication
     *
     * @var string
     */
    public $uri;

    /**
     * currently used method
     *
     * GET | POST | HEAD | PUT | DELETE ...
     *
     * @var string
     *
     */
    public $method = 'GET';

    /**
     * @var string
     */
    public $scheme;

    /**
     * Host name
     *
     * @var string
     */
    public $host;

    /**
     * Used port
     * @var string
     */
    public $port = 80;

    /**
     * Path part of URI
     * @var string
     */
    public $path;

    /**
     * Optional query string (part after ? in URI)
     * e.g: name=PeterParker
     *
     * @var string
     */
    public $queryString;

    /**
     * Fragment part of URI (after #)
     * @var string
     */
    public $fragment;


    public function __construct($host, $port = false)
    {
        if($port) {
            $this->port = $port;
        }
        parent::__construct($host, $this->port);
        $this->uri = $host;
        $this->parseUrl();
    }

    /**
     * Execute get method to HTTP server
     *
     * @param bool $host
     * @return Response
     */
    public function execute($host = false)
    {
        if ($host && is_string($host)) {
            $this->host = $host;
        }
        //TODO make it more configurable
        $in = $this->method . " / HTTP/" . Protocol::VERSION_11 . "\r\n";
        $in .= "Host: " . $this->host . "\r\n";
        $in .= "Connection: Close\r\n\r\n";
        $this->write($in);
        $response = new \P7Tools\Http\Response();
        $message = new \P7Tools\Http\Message($this->read());
        $response->setBody($message->body);
        $response->setHeaders(\P7Tools\Http\Parser::splitHeaders($message->header));
        return $response;
    }

    /**
     * Parsing given URI or URL and setting corresponding property for given parts
     */
    protected function parseUrl()
    {
        //Getting parts of URI
        $parts = parse_url($this->uri);

        //Getting scheme if applicable
        if (isset($parts['scheme'])) {
            $this->scheme = $parts['scheme'];
        }

        //Getting host if applicable
        if (isset($parts['host'])) {
            $this->address = $parts['host'];
            $this->host = $parts['host'];
        }

        //Getting port if applicable
        if (isset($parts['port']) && is_numeric($parts['port'])) {
            $this->port = $parts['port'];
        }

        //Getting path if applicable
        if (isset($parts['path'])) {
            $this->path = $parts['path'];
        }
        //Getting fragment if applicable
        if (isset($parts['fragment'])) {
            $this->fragment = $parts['fragment'];

        }
        //Getting query string if applicable
        if (isset($parts['query'])) {
            $this->queryString = $parts['query'];
        }

    }

    /**
     * @param $method
     * @param $data
     * @throws \ErrorException
     */
    public function __call($method, $data)
    {
        $method = strtoupper($method);
        switch($method) {

            case 'GET':

            case 'HEAD':
                $this->method = $method;
                $this->execute();
                break;

            default:
                throw new \ErrorException('undefined method' . $method);
        }
    }

}