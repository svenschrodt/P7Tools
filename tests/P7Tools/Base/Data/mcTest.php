<?php
/**
 * P7Tools\Base\Data\ContainerTest
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Base\Data;
use P7Tools\Base\File\Config;
use P7Tools\Dev\Mock;
use P7Tools\Cache\Memcache;
class mcTest extends \PHPUnit\Framework\TestCase
{

    public function testFoo()
    {
        $this->assertTrue(2*1==2);
    }
    
    
    
    public function NOtestIfPathWillGeneratedCorrectly()
    {
        /* OO API */
        //echo getcwd() . PHP_EOL;
        $memcache = Memcache::getInstance();
        $a = serialize(Mock::getUserAccountTotal());
        $memcache->set('fooBar', $a);

    }
}


