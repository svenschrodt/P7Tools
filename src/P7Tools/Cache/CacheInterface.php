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
namespace P7Tools\Cache;

Interface CacheInterface
{



    //protected function __construct($config);

    public static function getInstance();

    public function set($key, $value);
    public function get($key);
    public function delete($key);

}