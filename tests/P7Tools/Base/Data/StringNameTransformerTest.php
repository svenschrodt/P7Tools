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

class StringNameTransformerTest extends \PHPUnit\Framework\TestCase
{

    public function setUp(): void
    {
        $this->strings['snake_named'] = [
            'db_admin_DE',
            '__alt_System_default'
        ];
        $this->strings['camelized'] = [
            'dbAdminFoo',
            'MYSQLDbAdmin'
        ];
    }

    public function testUnderscored()
    {
        foreach ($this->strings['snake_named'] as $item) {
            $foo = StringNameTransformer::getcamelCasedString($item);

            $this->assertTrue(strstr($foo, '_') === false);
            $this->assertTrue(strstr($foo, ' ') === false);
        }
    }
    
    public function testCamelized()
    {
        foreach ($this->strings['camelized'] as $item) {
            $foo = StringNameTransformer::getsnakeCasedString($item);
//             echo $foo . PHP_EOL;
            $this->assertTrue(strstr($foo, '_') !== false);
            $this->assertTrue(strstr($foo, '_') !== false);
        }
        
    }
}


 