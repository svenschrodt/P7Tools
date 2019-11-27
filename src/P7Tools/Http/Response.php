<?php declare(strict_types=1);
/**
 * P7Tools\Http\Response
 *
 * Class to manage HTTP responses in context of Web MVC application
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

class Response
{
    /**
     * HTTP status code of current response
     * initialized with OK
     *
     * @var int
     */
    protected $currentStatus = 200;

    /**
     * Response header fields acc. to RFC 216 sec 6 ''
     *
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec6.html#sec6.2
     * @var array
     */
    protected $headers = array();

    /**
     * HTTP Header Lines
     *
     * @var string
     */
    protected $headerLines;

    /**
     * HTTP pay load
     * @var string
     */
    protected $body;

    /**
     * Instance of \P7Tools\Http\Protocol for accessing general http protocol
     *
     *
     * @var Protocol
     */
    protected $protocol;

    /**
     * HTTP message (header lines and body)
     *
     * @var string
     */
    protected $message;

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->protocol = new Protocol();
    }

    /**
     * Setting current http status code
     *
     * @param $status
     */
    public function setStatusCode($status)
    {
        // Checking if code is a valid status code (== key in array $this->statusCodes)
        if (!in_array($status, array_keys($this->protocol->statusCodes))) {
            throw new \InvalidArgumentException('Invalid Code');
        } else {
            $this->currentStatus = $status;
        }
    }

    /**
     * Returning current status code
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->currentStatus;
    }

    /**
     * Initialize response with some default values
     *
     * @param bool $setDefaultHeaders *
     *
     */
    public function init($setDefaultHeaders = false)
    {
        if ($setDefaultHeaders) {
            // (over) writing headers by default
            $this->headers['P7Tools-Awareness-Factor'] = 'Mega-Ubercool';
            $this->headers['Content-Type'] = 'text/html;charset=utf-8';
            $this->headers['X-Powered-By'] = 'P7Tools ' . \P7Tools\Meta::VERSION . ' running on PHP/' . phpversion();
        }
    }

    /**
     * Setting HTTP header $name to $value
     *
     * @param $name
     * @param $value
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * Getting HTTP header $name
     *
     * @param $name
     * @param $value
     */
    public function getHeader($name)
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : $this->headers[$name];
    }


    /***
     * Setting all HTTP headers of current instance
     *
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        if(is_array($headers)) {
            $this->headers = $headers;
        } elseif($headers instanceof \P7Tools\Base\Data\Container) {
            $this->headers = \P7Tools\Base\Data\Transformer::getArrayFromContainerObject($headers);
        }

    }

    /***
     * Returning all HTTP headers of current instance
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Setting responsive body of current instance
     *
     * @param $body
     *
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Returning responsive body of current instance
     *
     * @param $body
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }


    /**
     * Sending currently set headers (array $this->headers)
     */
    public function sendHeaders()
    {
        // Setting up status code (first line of headers)
        http_response_code($this->currentStatus);
        // Setting all other headers
        foreach ($this->headers as $key => $val) {
            header($key . ': ' . $val);
        }
    }
} 