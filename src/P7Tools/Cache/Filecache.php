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
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Cache;

use P7Tools\Base\File\Config;

class Filecache implements CacheInterface
{

    const FILE_PREFIX = 'P7ToolsCache';

    protected $_cacheDir = null;

    // Default is no lifetome, cached until updated or deleted
    protected $_timeToLive = 0;

    protected static $_instance = null;

    private static $__cache = array();

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function set($key, $data)
    {
        // @TODO check, if is writable
        $fn = $this->_getFileName($key);
        self::$__cache[$key] = $data;
        file_put_contents($fn, serialize($data));
    }

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

    protected function __construct($options = false)
    {
        // @TODO validate
        if (! $options) {
            $options = Config::getConfig('cache');
        }

        // @TODO $config to _handleOptions
        $this->_handleOptions($options);
        // var_dump($this->_cacheDir);die;
    }

    protected function _getFileName($key)
    {
        return $this->_cacheDir . '/' . self::FILE_PREFIX . '__' . $key;
    }

    protected function _handleOptions($options)
    {
        $this->_cacheDir = implode(DIRECTORY_SEPARATOR, array(
            APP_ROOT,
            $options['file_cache_dir']
        ));
    }
}