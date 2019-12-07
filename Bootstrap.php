<?php declare(strict_types = 1);
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
define('P7T_LIB_DIR', 'P7Tools');
/**
 *
 * @todo Writing PSR* compliant using auto loader with
 *       namespaces,registering namespaces by path resources & sauce and hot
 *      
 */

spl_autoload_register(function ($className) {
    
    // Getting parts of (sub) namespaces from URI    
    $parts = explode('\\', $className);
    
    // Check if namespace of class to be instantiated is belonging to us (P7Tools framework)
    if (substr($className, 0, 7) === P7T_LIB_DIR) {
        $file = 'src/' . str_replace('\\', '/', $className) . '.php';

        // Check if destination class file exists
        if (file_exists($file)) {
            require_once $file;
        } else { // trow exception, if not
            throw new FileException(sprintf(FileException::NO_SUCH_FILE_OR_DIRECTORY, $className));
        }
    }
    
    
});

