<?php
/**
 * Bootstrapping for namespace /P7Tools/ used by
 *  
 * - PHPUnit
 * - @ TODO configurable application namespace
 * 
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package SvenSchrodt\P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.1
 * @since 2019-11-21
 */

define('P7T_NS', '\\P7Tools');

/**
 * @todo Writing PSR* compliant using auto loader with
 *       namespaces, sauce and hot
 *      
 * @todo Writing class for registering namespaces by path resources
 */

spl_autoload_register(function ($className) {
    $parts = explode('\\', $className);
    // @TODO Check for valid path and existing resources
    if (substr($className, 0, 7) == 'P7Tools') {
        require_once 'src/' . str_replace('\\', '/', $className) . '.php';
    }
    ;
});

