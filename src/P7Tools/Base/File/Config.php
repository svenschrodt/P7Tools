<?php declare(strict_types = 1);
/**
 * \Base\File\Config 
 * 
 * Class representing file based configurations
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
 
namespace P7Tools\Base\File;

class Config
{

    /**
     * Static member holding info from file system based configuration 
     * @var array | null;
     */
    protected static $_config = null;

    /**
     * Getting config information 
     * 
     * @param boolean $sectionOnly
     * @return NULL|array
     */
    public static function getConfig($sectionOnly = false)
    {
        if (is_null(self::$_config)) {
            self::readConfigFile();
        }
        if ($sectionOnly) {
            return (isset(self::$_config[$sectionOnly])) ? self::$_config[$sectionOnly] : null;
        } else {
            return self::$_config;
        }
    }

    /**
     * @TODO - getting file path info dynamically
     */
    protected static function readConfigFile()
    {
        self::$_config = parse_ini_file('.local.conf.php', true);
    }
}