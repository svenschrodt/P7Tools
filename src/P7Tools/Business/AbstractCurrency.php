<?php declare(strict_types = 1);
/**
 *  \P7Tools\Business\AbstractCurrency
 *
 *  Abstract foundation class for class representing currencies ($, € etc.)
 * @todo 
 *      
 *       !Do not use in production until it is stable!
 *      
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 04.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Business;

class AbstractCurrency extends \P7Tools\Base\Type\FloatClass
{

    public function downTo($to, $step=0.01)
    {
        return parent::downTo($to, $step);
    
    }
    
    public function upTo($to, $step=0.01)
    {
        return parent::downTo($to, $step);
    }
}
