<?php declare(strict_types=1);
/**
 * \Cache\Filecache
 *
 * convention by default:
 *
 * - return null on unset data
 * - no ttl, but possible to be updated
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

class Filecache implements CacheInterface
{

    /**
     * Constant holding default file name prefix, used if none other will be specified 
     * 
     * @var string
     */
    const FILE_PREFIX = 'P7ToolsCache';

    /**
     * Directory holding cached data in file system resources
     * 
     * @var string | null
     */
    protected $_cacheDir = null;

    /**
     * TTL for cached data - default 0 means: no lifetome, cached until updated or deleted
     * 
     * @var integer
     */
    protected $_timeToLive = 0;

    /**
     * Static (singleton) instance of Filecache
     *  
     * @var FileCache | null
     */
    protected static $_instance = null;

    /**
     * Static array with meta information of named properties in cache 
     * 
     * @var array
     */
    private static $__cache = array();

    /**
     * Static getter for (singleton) instance of Filecache
     * 
     * @return Filecache
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Setting named property to cache
     * 
     * @param string $key
     * @param mixed $data
     * @return Filecache
     */
    public function set(string $key, $data) : Filecache
    {
        // @TODO check, if is writable
        $fn = $this->_getFileName($key);
        self::$__cache[$key] = $data;
        file_put_contents($fn, serialize($data));
    }

    /**
     * Getting named property from cache 
     * 
     * @param string $key
     * @return mixed|NULL
     */
    public function get($key)
    {
        if (isset(self::$__cache[$key])) {
            return self::$__cache[$key];
        }
        $fn = $this->_getFileName($key);
        if (file_exists($fn)) {
            return unserialize(file_get_contents($fn));
        } else {
            return null;
        }
    }

    /**
     * Deleting named property from cache
     * 
     * @param string $key
     * @return boolean
     */
    public function delete($key)
    {
        if (isset(self::$__cache[$key])) {
            unset(self::$__cache[$key]);
        }
        $fn = $this->_getFileName($key);
        if (file_exists($fn)) {
            unlink($fn);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Protected constructor (singleton)
     * 
     * @param boolean $options
     */
    protected function __construct($options = false)
    {
        // @TODO validate
        if (! $options) {
            $options = Config::getConfig('cache');
        }

        // @TODO $config to _handleOptions
        $this->_handleOptions($options);
    }

    /**
     * Getting file name resource for property amed $key
     * 
     * @param string $key
     * @return string
     */
    protected function _getFileName($key)
    {
        return $this->_cacheDir . '/' . self::FILE_PREFIX . '__' . $key;
    }
    
    /**
     * @todo handlinh optional parameters for cache behaviour
     * 
     * @param array $options
     * @return bool
     */
    protected function _handleOptions($options) : bool
    {
        //@FIXME
        $this->_cacheDir = implode(DIRECTORY_SEPARATOR, array(
            APP_ROOT,
            $options['file_cache_dir']
        ));
        return true;
    }
}