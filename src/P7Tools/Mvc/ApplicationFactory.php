<?php declare(strict_types = 1);
/**
 * P7Tools\Mvc\ApplicationFactory
 * 
 * Class starting Mvc application and de-coupling from global context
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

class ApplicationFactory
{
    
    public function registerNamespace(callable $applicationInit)
    {
        $applicationInit();
    }
    
}


