<?php
declare(strict_types = 1);
/**
 * P7Tools\Mvc\Application
 *
 * !Do not use in production until it is stable!
 *
 *
 * @todo - rewrite, since routing was re-implemented in \P7Tools\Mvc\Router
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-02
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Mvc;

use P7Tools\Base\File\Config;

class Application
{

    /**
     * Name of (non-existing) application for testing purposes only
     *
     * @var string
     */
    const MOCK_APP = 'dry-run';

    /**
     * Name of current application 
     * 
     * @var string
     */
    protected $_appName = '';

    /**
     * Instance of application router
     * 
     * @var \P7Tools\Mvc\Router $_router
     */
    protected $_router;
    
    /**
     * Instance of current http request
     * 
     * @var \P7Tools\Http\Request 
     */
    protected $_request;
    
    /**
     * Instance of current http response
     * 
     * @var \P7Tools\Http\Response
     */
    protected $_response;
    
    /**
     * Current controller for response
     * 
     * @var \P7Tools\Mvc\FrontController
     */
    protected $_controller;
    
    /**
     * Name of current action for response
     * 
     * @var string 
     */
    protected $_action;
    
    /**
     * Mixed arrayy with parameters
     * 
     * @var array
     */
    protected $_params;

    /**
     * Costructor function 
     *  - init Routing and dispatching
     *  
     * @param string $appName
     */
    public function __construct(string $appName = self::MOCK_APP)
    {
        $this->_appName = $appName;

        $this->_router = Router::getInstance();
        $this->_controller = $this->_router->getController();
        $this->_action = $this->_router->getAction();
        
        if ($this->_appName != self::MOCK_APP) {
            $this->_checkApplicationSanity();
        }
    }


    
    /**
     * Running application 
     *  -> calling current action of current controller
     * 
     * @return \P7Tools\Mvc\Application
     */
    public function run() : \P7Tools\Mvc\Application
    {
        /**
         * Temp. while DEV showing member attributes 
         * @var array $object
         */
        $object = [
            'ctr' => $this->_controller,
            'act' => $this->_action,
            'rtr' => $this->_router,
            'app' => $this->_appName,
            'rsp' => $this->_response,
            'env' => $_ENV
        ];
//         var_dump($this); 
// // get fully qualified name of application's controllers
//         $controller = APP_NS . '\\Controllers\\' . $this->controller . 'Controller';
//         $action = $this->action;
//         // echo \STools\Dev\Helper::getInfo(array($controller, $action));
//         $controllerInstance = new $controller($this);
//         $controllerInstance->$action();
//         return $controllerInstance;
        return $this;
    }

    /**
     * Checking, if application directories and sub directories exist
     *
     * @todo Implementing sanity checks for application and remove fake code
     * @return bool
     */
    protected function _checkApplicationSanity(): bool
    {
        return true;
        if (true) {
             throw new ApplicationException(sprintf(ApplicationException::MISSING_APPLICATION_PATH, $this->_appName));
        }
        return true;
    }
}