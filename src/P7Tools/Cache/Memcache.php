<?php declare(strict_types=1);
/**
 * Simplified basic usage of memcache daemon - a key-value storing cache holding data 
 * in RAM and communicating via TCP/IP socket
 *
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
namespace P7Tools\Cache;

use P7Tools\Base\File\Config;

class Memcache implements CacheInterface
{

    /**
     * Type of storage 
     * 
     * @var string
     */
    protected static $_storageType = MEMCACHE_COMPRESSED;

    /**
     * TTL for chached data 
     * 
     * @var integer
     */
    protected static $_timeToLive = 60;

    /**
     * Static (singleton) instance of Memcache
     * 
     * @var Memcache | null 
     */
    protected static $_instance = null;

    /**
     * Meta information of cached data 
     * 
     * @var null | array 
     */
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

    /**
     * Static getter for (singleton) instance of Filecache
     * 
     * @return Memcache
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Setter for named property 
     * 
     * @param string $key
     * @param mixed $value
     * @return Memcache
     */
    public function set($key, $value)
    {
        self::$_cache->set($key, $value, self::$_storageType, self::$_timeToLive);
        return $this;
    }

    /**
     * Getter for named property
     * 
     * @param string  $key
     * @return mixed
     */
    public function get($key)
    {
        return self::$_cache->get($key, self::$_storageType);
    }

    /**
     * Deleting named property from cache
     * 
     * @param string $key
     * @return bool
     */
    public function delete($key)
    {
        return self::$_cache->delete($key);
    }
}