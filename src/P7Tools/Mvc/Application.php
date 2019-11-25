<?php
/**
 * P7Tools\Mvc\Application
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Mvc;
use P7Tools\Base\File\Config;

class Application
{

    /**
     */

    // read only properties (from outside of the class) -> see __get()
    protected $request, $response, $controller, $action, $params;

    // TODO put this in your config area
    public static $showDebugInfo = false;

    /*
     * TODO change to constructor with injected \P7Tools\Http\Request
     * and \P7Tools\Http\Response instead of instantiating them here
     */
    public function __construct()
    {
        // TODO think about user defined routing in the future
        $this->request = new \P7Tools\Http\Request();
        $parts = $this->request->getUrlParts();
        $this->response = new \P7Tools\Http\Response();
        // base route ::
        // $controller/$action/param-key1/paramVal1//paramkeyN/paramValN

        // prefix url path
        // \P7Tools\Dev\Helper::printInfo($parts);
        // controller prefix name is 'uppercase first' e.g: TestController
        $this->controller = ucfirst(strtolower(array_shift($parts)));
        // action name prefix comes 'as is'
        $this->action = array_shift($parts);

        $this->params = $this->parseUriParams($parts);

        if(is_null($this->controller) || strlen($this->controller) == 0) {
            $this->controller = 'Index';
        }
        if(is_null($this->action) || strlen($this->action) == 0) {
            $this->action = 'index';
        }
    }

    /**
     * Starting application
     *
     * @return mixed
     *
     */
    public function run()
    {
        // get fully qualified name of application's controllers
        $controller = APP_NS . '\\Controllers\\' . $this->controller . 'Controller';
        $action = $this->action;
        // echo \P7Tools\Dev\Helper::getInfo(array($controller, $action));
        $controllerInstance = new $controller($this);
        // $controllerInstance
        $viewPath = implode('/', array($this->controller,$this->action));
        $controllerInstance->view = new \P7Tools\Mvc\TemplateView($viewPath);
        // // Execute the action
        /**
         * @TODO -> thik, if usage is better like this?
         * call_user_func_array(array($controllerInstance, $action), $params);
         */
        $controllerInstance->$action();
        return $controllerInstance;
    }

    /**
     * Magical interceptor function dor application's properties
     *
     * @param
     *            $name
     * @return mixed|null|\P7Tools\Http\Request|\P7Tools\Http\Response|string
     */
    public function __get($name)
    {
        switch($name) {

            case 'params':
                return $this->params;
                break;

            case 'action':
                return $this->action;
                break;

            case 'controller':
                return $this->controller;
                break;

            case 'request':
                return $this->request;
                break;

            case 'response':
                return $this->response;
                break;

            default:
                return null;
        }
    }

    /**
     * Returning property named $key, or null if not existing
     *
     * @param
     *            $key
     * @return null
     */
    public function getParam($key)
    {
        return (isset($this->params[$key])) ? $this->params[$key] : null;
    }

    /**
     * Parsing URI to get optional parameters and migrate it with request
     * parameters
     *
     * @param array $parts
     * @return mixed
     *
     */
    protected function parseUriParams(array $parts)
    {
        // TODO -> to other class
        $params = array();
        while(count($parts) != 0) {
            $key = array_shift($parts);
            if(count($parts) != 0) {
                $val = array_shift($parts);
            } else {
                $val = null;
            }
            $params[$key] = $val;
        }
        $params = array_merge($params, $_REQUEST);
        return $params;
    }
}