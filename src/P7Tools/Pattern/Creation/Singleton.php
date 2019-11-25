<?php declare(strict_types=1);
/**
 * P7Tools\lib\Pattern\Creation\Singleton
 *
 * Abstract class helping to implement singleton design pattern
 * (or anti-pattern - not to be discussed here)
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Pattern\Creation;

abstract class Singleton
{
    /**
     * @var static member representing instance of current Singleton implementation
     */
    protected  static $_instance = null;

    /**
     * protected constructor function, avoiding direct instantiation
     *
     * Executable code for test purpose only
     *
     */
    protected function __construct()
    {
        //TODO remove constructor's content
        $name = get_class($this);
      // echo 'creating ' . $name . ' @ ' . date('Y-m-d H:i:s');
    }

    /**
     * Avoiding cloning
     */
    private function __clone()
    {

    }
    /**
     * Returning unique instance of currently implemented class
     *
     * @return \P7Tools\Pattern\Creation\Singleton
     */
    public static function _getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new static();
        }
            return static::$_instance;
    }


}
