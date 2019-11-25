<?php declare(strict_types = 1);
/**
 * P7Tools\Mvc\Router
 *
 * Routing given URI to Controller name, action name and parameter list
 *
 * @todo Implementing:
 *       - REGEX-based Routing and
 *       - static routes
 *      
 *       !Do not use in production until it is stable!
 *      
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Mvc;

class Router
{

    /**
     * Current instance of Router (Singleton)
     *
     * @var \P7Tools\Mvc\Router | null
     */
    private static $_instance = null;

    /**
     * Document root (in file system)of current application
     * (root directory with index.php and .htaccess)
     *
     * @var string
     */
    private $_appDocRoot = '';

    /**
     * Application Http Root (in URI) of current application
     * (root directory with index.php and .htaccess)
     *
     * @var string
     */
    private $_appHttpRoot = '';

    /**
     * Name of current controller,extracted from URI by routing
     *
     * @var string
     */
    private $_controller = '';

    /**
     * Name of current action (method function of ccurrent controller),extracted
     * from URI by routing
     *
     * @var string
     */
    private $_action = '';

    /**
     * Current parameters,extracted from URI by routing
     * + HTTP GET parameters (from super global $_GET)
     *
     * (separated form URL by '?')
     *
     * @var array
     */
    private $_get = array();

    /**
     * Current POST parameters send within payload, when method POST is used
     * (extracted from super global $_POST)
     *
     * @var array
     */
    private $_post = array();

    /**
     * Current PUT parameters send within payload, when method PUT is used
     * (extracted from PHP input stream 'php://')
     *
     * Hint: this input stream can only be read once 
     *
     * @var array
     */
    private $_put = array();

    /**
     * Name of index file used for bootstrapping
     *
     * @var string
     */
    private $_index = 'index.php';

    /**
     * Private constructor function for being Router Singleton
     * 
     */
    private function __construct()
    {
        $this->_init();
    }

    // @TODO private __clone etc. for ensuring being Singleton

    /**
     * Getting single/same instance of this Router by run time
     *
     * @return \P7Tools\Mvc\Router
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Getting application Routing information from URI and Http context data
     * [GET, POST; PUT etc.]
     * 
     * @TODO -> add commenting!
     * 
     */
    private function _init()
    {
        $parts = explode('/', $_SERVER['SCRIPT_FILENAME']);
        $this->_index = array_pop($parts);
        $this->_appDocRoot = implode('/', $parts);
        $this->_appHttpRoot = str_replace($this->_index, '', $_SERVER['SCRIPT_NAME']);

        $tmp = str_replace($this->_appHttpRoot, '', $_SERVER['REQUEST_URI']);
        $applicationParts = explode('/', $tmp);

        if (substr($tmp, - 1, 1) == '/') {
            array_pop($applicationParts);
        }
        foreach ($applicationParts as $no => $val) {
            if (strlen($applicationParts[$no]) === 0) {
                unset($applicationParts[$no]);
            }
        
        }
//         var_dump($applicationParts);
//         var_dump(count($applicationParts));die;
        switch (count($applicationParts)) {
            case 0:
                echo "0";
                $this->_controller = 'default';
                $this->_action = 'default';
                break;
            case 1:
                echo "1";
                $this->_controller = array_shift($applicationParts);
                $this->_action = 'default';
                break;
            default:
                echo ">1";
                $this->_controller = array_shift($applicationParts);
                $this->_action = array_shift($applicationParts);
                $this->_get = $applicationParts;
                if(count($_GET)>0) {
                    $this->_get = array_merge($this->_get , $_GET);
                }
        }

        
    }
}