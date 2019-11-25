<?php
/**
 * Bootstrapping for PHPUnit

 * Hint: due to the fact, that this project is addressing German accounting schema,
 * the naming convention of classes, methods and variables/attributes etc. will use
 * German terms and abbreviations whenever it seems to be useful
 *
 * @link https://github.com/svenschrodt/Rechnungswesen
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package SvenSchrodt\Rechnungswesen
 * @license https://github.com/svenschrodt/Rechnungswesen/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.1
 * @since 2019-11-21
 */

define('P7T_NS', '\\P7Tools');

/**
 * @TODO Writing PSR* compliant and SPL using auto loader with
 * namespaces, sauce and hot

  @TODO Writing class for  registering namespaces by path resources 
 */

// chdir(dirname(__DIR__));
spl_autoload_register(function ($className) {
    $parts = explode('\\', $className);
    // @TODO Check for valid path and existing resources
//  echo (PHP_EOL . $className .PHP_EOL .'src/' . str_replace('\\', '/', $className) . '.php'.PHP_EOL.PHP_EOL);
    
    if (substr($className, 0, 7) == 'P7Tools') {
        require_once 'src/' . str_replace('\\', '/', $className) . '.php';
    };
    
});

