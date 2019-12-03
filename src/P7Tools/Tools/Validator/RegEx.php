<?php declare(strict_types = 1);
/**
 * \P7Tools\Tools\Validator\RegEx
 * 
 * 
 * Validation object against regular expressions
 *
 *
 * @todo Commenting, Adding $Documentdation.md
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
namespace  P7Tools\Tools\Validator;

class RegEx implements \P7Tools\Tools\ValidatorInterface
{
    /**
     * Main function validating input object against regular expressions
     * 
     * @param object $object
     * @return bool
     */    
    public function isValid(object $object, string $pattern) : bool
    {
        //@todo 
    }
}
