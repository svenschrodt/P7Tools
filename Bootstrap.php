<?php
/**
 * Bootstrapping for namespace /P7Tools/ used by
 *  
 * - PHPUnit
 * - @ TODO configurable application namespace
 * 
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
use P7Tools\Base\File\Exception as FileException;

define('P7T_NS', '\\P7Tools');
define('PROJECT', 'P7Tools');
/**
 *
 * @todo Writing PSR* compliant using auto loader with
 *       namespaces, sauce and hot
 *      
 * @todo Writing class for registering namespaces by path resources
 */

spl_autoload_register(function ($className) {
    $parts = explode('\\', $className);
    
    // Check if namespac of class to be instantiated is blongng to us
    if (substr($className, 0, 7) === PROJECT) {
        $file = 'src/' . str_replace('\\', '/', $className) . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new FileException(sprintf(FileException::NO_SUCH_FILE_OR_DIRECTORY, $className));
        }
    }
});

