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
     * Name of (no-exisiting) applicatin for testing purposes only
     *
     * @var string
     */
    const MOCK_APP = 'dry-run';

    /**
     *
     * @var string
     */
    protected $_appName = '';

    // read only properties (from outside of the class) -> see __get()
    protected $_router, $_request, $_response, $_controller, $_action, $_params;

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

    public function run()
    {
        $object = [
            'ctr' => $this->_controller,
            'act' => $this->_action,
            'rtr' => $this->_router,
            'app' => $this->_appName,
            'ctr' => $this->_response,
            'act' => $this->_request
        ];
        echo \P7Tools\Dev\Helper::getInfo($object, false, true);
    }

    /**
     * Checking, if application directories and sub directories exist
     *
     * @todo Implementing sanity checks for application
     * @return bool
     */
    protected function _checkApplicationSanity(): bool
    {
        if (1 == 2) {
             throw new ApplicationException(sprintf(ApplicationException::MISSING_APPLICATION_PATH, $this->_appName));
        }
        return true;
    }
}