<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Net\Client
 *
 * Simple TCP/IP | unix socket (endpoint for communication) client
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
namespace P7Tools\Net;


use P7Tools\Base\File\Exception;

class Client
{
    /**
     * Resource of type Socket
     *
     * Readonly
     *
     * @var int
     */
    protected $socket;

    // the following members may be set from outside the class (public members)

    /***
     * IP address or hostname | fqdn
     *
     * @var string
     */
    public $host;

    /***
     * IP address
     *
     * @var string
     */
    public $address;

    /**
     * TCP | UDP port - only used for IP v4 or 6 sockets
     *
     * @var int
     */
    public $port;

    /**
     * Protocol family - one of the following:
     *
     * AF_INET (Pv4 based)
     * AF_INET6 (IPv6 based)
     * AF_UNIX (local communication)
     *
     * @var int
     */
    public $domain;

    /**
     * Type of socket:
     *
     * SOCK_STREAM (full-duplex, connection-based byte streams e.g: TCP)
     * SOCK_DGRAM datagrams (connectionless, unreliable messages of a fixed maximum length) e.G: UDP
     * SOCK_SEQPACKET    (sequenced, reliable, two-way connection-based data transmission path for datagrams)
     * SOCK_RAW    (raw network protoco l access e.g: ICMP requests )
     * SOCK_RDM    (reliable datagram layer without guaranteed ordering ->   most likely not implemented on your os;)
     *
     * @var int
     */
    public $type;

    /**
     * Protocol:
     *
     * icmp (Internet Control Message Protocol)
     * udp    (User Datagram Protocol)
     * tcp (Transmission Control Protocol)
     *
     * @var int
     */
    public $protocol;

    protected $errorMessage = array();

    /**
     * Constructor with optional parameters
     * Protocol family IPv4, socket type stream and protocol TCp are set by default
     *
     * @param bool $address
     * @param bool $port
     * @param int $domain
     * @param int $type
     * @param int $protocol
     */
    public function __construct($address = false, $port = false, $domain = AF_INET, $type = SOCK_STREAM, $protocol = SOL_TCP)
    {
       $extensions = get_loaded_extensions();
        if(!in_array('sockets', $extensions)) {
            throw new \ErrorException('Extension "sockets" not present!');
        };

        // setting up default values for socket, if given
        $this->address = $address;
        $this->host = $address;
        $this->port = $port;
        $this->domain = $domain;
        $this->type = $type;
        $this->protocol = $protocol;
    }

    /**
     * Connecting to server socket
     *
     * @throws \ErrorException
     */
    public function connect()
    {
        //TODO implement better error handling with different error messages!!
        if (!$this->socketDataIsComplete()) {
            throw new \ErrorException('Error found in input data:'
                . implode("\n", $this->errorMessage));
        }
        //TODO validating params!!!
        // Creating socket and returning resource
        $this->socket = socket_create($this->domain, $this->type, $this->protocol);

        //  checking if given address is not a valid IP (v. 4 or 6) address,
        if (!filter_var($this->address, FILTER_VALIDATE_IP)) {
            $this->address = gethostbyname($this->address);
            // testing if fqdn or hostname can be resolved to address
            if (!filter_var($this->address, FILTER_VALIDATE_IP)) {
                throw new \ErrorException('Given host name / address could not be resolved ');
            }
        }

        // trying to connect or throw error exception
        if (!socket_connect($this->socket, $this->address, $this->port)) {
            $reason = socket_strerror(socket_last_error($this->socket));
            throw new \ErrorException('Could not connect to ' . $this->address . '@ port ' . $this->port . ' Reason: ' . $reason);
        }
    }

    /**
     * Check sanity of given data for establishing socket connection
     *
     * @return bool
     */
    public function socketDataIsComplete()
    {
        //TODO check if all necessary data for socket construction is available
        $success = true;
        if (!$this->address) {
            $success = false;
            $this->errorMessage[] = 'Address not set';
        }
        if (!$this->port) {
            $this->errorMessage[] = 'Port not set';
        }
        return $success;
    }

    /**
     * Writing data to socket
     *
     * @param $data
     * @return int
     */
    public function write($data)
    {
        // todo check for valid socket
        return socket_write($this->socket, $data, strlen($data));
    }

    /**
     * Reading from socket
     *
     * @param int $bytes
     * @return string
     */
    public function read($bytes = 2048)
    {
        $result = ' ';
        // todo check for valid socket
        while ($out = socket_read($this->socket, $bytes)) {
            $result .= $out;
        };
        return $result;
    }


}