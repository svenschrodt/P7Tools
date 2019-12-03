<?php declare(strict_types = 1);
/**
 * \P7Tools\Tools\ValidatorInterface
 * 
 * Defining public API for classes in sub namepace \P7Tools\Tools\Validator
 *
 *
 * @todo 
 *      
 *       !Do not use in production until it is stable!
 *      
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 03.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace  P7Tools\Tools;

interface ValidatorInterface
{
    /**
     * Main function validating input object in context
     * 
     * @param object $object
     * @return bool
     */    
    public function isValid(object $object) : bool;
}
