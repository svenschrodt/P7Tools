<?php declare(strict_types=1); declare(strict_types=1);
/**
 * \Base\File\Exception
 *
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Base\File;

class Config
{
    protected static $_config = null;

    public static function getConfig($sectionOnly = false)
    {
       if(is_null(self::$_config)) {
           self::readConfigFile();
       }
       if($sectionOnly) {
           return (isset(self::$_config[$sectionOnly]))?self::$_config[$sectionOnly]:null;
       } else {
           return self::$_config;
       }
    }

    protected static function readConfigFile()
    {
        
        self::$_config = parse_ini_file('.local.conf.php',true);
    }

}