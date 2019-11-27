<?php declare(strict_types = 1);
/**
 * P7Tools\Http\Client
 *
 * Simple HTTP client written in pure PHP
 *
 * Hint: this class demonstrates the general functionality of an http agent 
 * - for better performance (and stability?) use CurlClient instaead in production 
 * environments
 * 
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
     *
     * @var string
     */
    public $scheme = '';

    /**
     * Host name
     *
     * @var string
     */
    public $host = '';

    /**
     * Used port
     *
     * @var string
     */
    public $port = 80;

    /**
     * Path part of URI
     *
     * @var string
     */
    public $path = '';

    /**
     * Optional query string (part after ? in URI)
     * e.g: name=PeterParker
     *
     * @var string
     */
    public $queryString = '';

    /**
     * Fragment part of URI (after #)
     *
     * @var string
     */
    public $fragment = '';

    /**
     * Constructor
     *
     * @param string $host
     * @param boolean $port
     */
    public function __construct(string $host, int $port = 80)
    {
        if ($port) {
            $this->port = $port;
        }
        parent::__construct($host, $this->port);
        $this->uri = $host;
        $this->parseUrl();
    }

    /**
     * Execute get method to HTTP server
     *
     * @param string $host
     * @return Response
     */
    public function execute(string $host = '')
    {
        if ($host && is_string($host)) {
            $this->host = $host;
        }
        // TODO make it more configurable
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
        // Getting parts of URI
        $parts = parse_url($this->uri);

        // Getting scheme if applicable
        if (isset($parts['scheme'])) {
            $this->scheme = $parts['scheme'];
        }

        // Getting host if applicable
        if (isset($parts['host'])) {
            $this->address = $parts['host'];
            $this->host = $parts['host'];
        }

        // Getting port if applicable
        if (isset($parts['port']) && is_numeric($parts['port'])) {
            $this->port = $parts['port'];
        }

        // Getting path if applicable
        if (isset($parts['path'])) {
            $this->path = $parts['path'];
        }
        // Getting fragment if applicable
        if (isset($parts['fragment'])) {
            $this->fragment = $parts['fragment'];
        }
        // Getting query string if applicable
        if (isset($parts['query'])) {
            $this->queryString = $parts['query'];
        }
    }

    /**
     * Magical interceptor function used as generic request for http methods
     *
     * @param sting  $method
     * @param string $data
     * @return Client
     * @throws \ErrorException
     */
    public function __call(string $method, string $data)
    {
        $method = strtoupper($method);
        switch ($method) {

            case 'GET':

            case 'HEAD':
                $this->method = $method;
                $this->execute();
                break;

            default:
                throw new \ErrorException('undefined method' . $method);
        }
        return $this;
    }
}