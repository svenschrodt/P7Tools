<?php declare(strict_types=1);
/**
 * Simplified basic usage of memcache daemon
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
namespace P7Tools\Cache;

use P7Tools\Base\File\Config;

class Memcache implements CacheInterface
{

    protected static $_storageType = MEMCACHE_COMPRESSED;

    protected static $_timeToLive = 60;

    protected static $_instance = null;

    protected static $_cache = null;

    protected function __construct($config = false)
    {
        // @TODO validate
        if (! $config) {
            $config = Config::getConfig('cache');
        }
        self::$_cache = new \Memcache();
        self::$_cache->addServer($config['memcache_host'], $config['memcache_port']);
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function set($key, $value)
    {
        self::$_cache->set($key, $value, self::$_storageType, self::$_timeToLive);
    }

    public function get($key)
    {
        return self::$_cache->get($key, self::$_storageType);
    }

    public function delete($key)
    {
        return self::$_cache->delete($key);
    }
}