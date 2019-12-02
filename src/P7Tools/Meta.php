<?php declare(strict_types=1);
/**
 * P7Tools\Meta - meta information for P7Tools
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
namespace P7Tools;

class Meta
{
    /**
     * Current version of P7Tools library
     */
    const VERSION = '0.1';

    /**
     * Location of project repository
     */
    const PROJECT_REPOSITORY = 'https://github.com/svenschrodt/P7Tools';

    /**
     * Location of used continuous integration platform
     */
    const CI_PLATFORM = 'https://travis-ci.org/svenschrodt/P7Tools/';

    /**
     * Static boolean to check, if application is in debug mode
     *
     * @var bool
     */
    protected static $debugMode = false;

    /**
     * Setting debug mode (bool) status
     *
     * @param bool $status
     */
    public static function setDebugMode(bool $status=false)
    {
        self::$debugMode = (bool) $status;
    }

    /**
     * Getting current debug mode status
     *
     * @return bool
     */
    public static function getDebugMode(): bool
    {
        return self::$debugMode;
    }

    /**
     * Getting current Environment (CLI, *-CGI, apche*, etc.)
     *
     * @return string
     */
    public static function getEnvironment() : string
    {
        return php_sapi_name();
    }

    /***
     * Getting information about defined constants
     *
     *
     *
     * @param mixed $type
     * @return array
     */
    public static function getConstants($type=false) : array
    {
        $constants = get_defined_constants(true);
        if($type && array_key_exists(strtolower($type), $constants)) {
            return $constants[strtolower($type)];
        }
        return $constants;
    }
}

