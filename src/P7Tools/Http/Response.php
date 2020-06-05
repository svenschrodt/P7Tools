<?php
declare(strict_types = 1);
/**
 * P7Tools\Http\Response
 *
 * Class to manage HTTP responses in context of Web MVC application
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

class Response
{

    /**
     * HTTP status code of current response
     * initialized with OK
     *
     * @var int
     */
    protected $currentStatus = 0;

    /**
     * Response header fields acc.
     * to RFC 216 sec 6 ''
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
     *
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
     */
    public function __construct()
    {
        $this->protocol = new Protocol();
    }

    /**
     * Setting current http status code
     * 
     * @param string $status
     * @throws \InvalidArgumentException
     * @return \P7Tools\Http\Response
     */
    public function setStatusCode( string $status) : Response
    {
        // Checking if code is a valid status code (== key in array $this->statusCodes)
        if (! in_array($status, array_keys($this->protocol::$statusCodes))) {
            throw new \InvalidArgumentException('Invalid Code');
        } else {
            $this->currentStatus = (int) $status;
        }
        
        return $this;
    }

    /**
     * Returning current status code
     *
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->currentStatus;
    }

    /**
     * Initialize response with some default values
     *
     * @param bool $setDefaultHeaders
     * @todo Make it protected after DEV phase
     */
    public function init(bool $setDefaultHeaders = false)
    {
        if ($setDefaultHeaders) {
            // (over) writing headers by default
            $this->headers['P7Tools-Awareness-Factor'] = 'Mega-Ubercool';
            $this->headers['X-Powered-By'] = 'P7Tools ' . \P7Tools\Meta::VERSION . ' running on PHP/' . phpversion();
        }
    }

    /**
     * Setting HTTP header $name to $value
     *
     * @param string $name
     * @param string $value
     * @return Response
     */
    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Getting HTTP header $name
     *
     * @param string $name
     */
    public function getHeader(string $name): string
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : $this->headers[$name];
    }

    /**
     * Setting all HTTP headers of current instance
     *
     * @param array $headers
     * @return \P7Tools\Http\Response
     */
    public function setHeaders(array $headers)
    {
        if (is_array($headers)) {
            $this->headers = $headers;
        } elseif ($headers instanceof \P7Tools\Base\Data\Container) {
            $this->headers = \P7Tools\Base\Data\Transformer::getArrayFromContainerObject($headers);
        }
        return $this;
    }

    /**
     * Returning all HTTP headers of current instance
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Setting body of current instance
     *
     * @param string $body
     * @return Response
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Returning body of current instance
     *
     * @return string $body
     * @return mixed
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sending currently set headers (array $this->headers)
     *
     * @return Response
     */
    public function sendHeaders()
    {
        // Setting up status code (first line of headers)
        http_response_code($this->currentStatus);
        // Setting all other headers
        foreach ($this->headers as $key => $val) {
            header($key . ': ' . $val);
        }
        return $this;
    }
} 