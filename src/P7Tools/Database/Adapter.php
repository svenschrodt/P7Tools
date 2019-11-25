<?php
/**
 * P7Tools\lib\Database\ExampleAdapter
 *
 * Abstract class helping to implement singleton design pattern
 * (or anti-pattern - not to be discussed here)
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Database;
//@TODO make it abstract and inherit from it
class Adapter extends \P7Tools\Pattern\Creation\Singleton
{

    public static function quote($value)
    {
        $type = gettype($value);
        //@TODO deciding by type, how to quote
        switch($type) {
            default:
                return sprintf("'%s'", $value);
        }
    }

}
