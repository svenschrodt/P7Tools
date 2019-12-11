<?php declare(strict_types = 1);
/**
 * \P7Tools\Mvc\ApplicationException 
 * 
 * Exception(s) thrown, when errors occure while initializing,
 * dispatching or running by application
 *
 * @todo !Do not use in production until it is stable!
 *      
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

class ApplicationException extends \ErrorException
{
    /**
     * Constants for application error messages
     * @var string
     * 
     */

    /**
     * The mandatory (pre defined per config | convention) 
     * application directories are missing
     *  
     * @var string
     */
    const MISSING_APPLICATION_PATH = "Missing directory structure for application '%s'";
}
