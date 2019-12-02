<?php declare(strict_types = 1);
/**
 * \P7Tools\Cache\CacheInterface
 *
 * Defining common API for classes implementing caching mechanisms
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

Interface CacheInterface
{

    /**
     * Static getter for current (singleton) instance
     */
    public static function getInstance();

    /**
     * Setting $value identified by named $key in cache
     *
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value): CacheInterface;

    /**
     * Getting property identified by named $key from cache
     *
     * @param string $key
     */
    public function get(string $key);

    /**
     * Deleting property identified by named $key from cache
     * 
     * @param string $key
     * @return CacheInterface
     */
    public function delete(string $key): CacheInterface;
}