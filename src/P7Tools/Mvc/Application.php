<?php declare(strict_types=1);
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
 * @version 0.1
 */
namespace P7Tools\Mvc;


class Application
{
    /**
     *
     */


    // read only properties (from outside of the class) -> see __get()
    protected $request, $response, $controller, $action, $params;

    // TODO put this in your config area
    public static $showDebugInfo = false;


    /* TODO change to constructor with injected \P7Tools\Http\Request
     and \P7Tools\Http\Response instead of instantiating them here */

    public function __construct()
    {
        // TODO think about user defined routing in the future
        $this->request = new \P7Tools\Http\Request();
        $parts = $this->request->getUrlParts();
        $this->response = new \P7Tools\Http\Response();
        //base route :: $controller/$action/param-key1/paramVal1//paramkeyN/paramValN
        // controller prefix name  is 'uppercase first' e.g: TestController
        $this->controller = ucfirst(strtolower(array_shift($parts)));
        // action name prefix comes 'as is'
        $this->action = array_shift($parts);
        $this->params = $this->parseUriParams($parts);

        if (is_null($this->controller) || strlen($this->controller) == 0) {
            $this->controller = 'Index';
        }
        if (is_null($this->action) || strlen($this->action) == 0) {
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
        $controllerInstance->$action();
        return $controllerInstance;
    }

    /**
     *
     * @param $name
     * @return mixed|null|\P7Tools\Http\Request|\P7Tools\Http\Response|string
     */
    public function __get($name)
    {
        switch ($name) {

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
     * @param $key
     * @return null
     */
    public function getParam($key)
    {
        return (isset($this->params[$key])) ? $this->params[$key] : null;
    }


    /**
     * Parsing URI to get optional parameters and migrate it with request parameters
     *
     * @param array $parts
     * @return mixed
     *
     *
     */
    protected function parseUriParams(array $parts)
    {
        //TODO -> to other class
        $params = $_REQUEST;
        while (count($parts) != 0) {
            $key = array_shift($parts);
            if (count($parts) != 0) {
                $val = array_shift($parts);
            } else {
                $val = null;
            }
            $params[$key] = $val;
        }
        return $params;
    }
}