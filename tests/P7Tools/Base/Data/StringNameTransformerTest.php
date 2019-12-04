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

    protected $strings = [];

    public function setUp() : void
    {
        $this->strings['underscored'] = ['db_admin_DE', '__alt_System_default'];
        $this->strings['camelized'] = ['dbAdmiFoo', 'MYSQLDbAdmin'];
    }


    public function testNetstring()
    {

//         foreach($this->strings['underscored'] as $item) {
//             echo StringNameTransformer::getcamelCasedString($item).PHP_EOL;
//             echo StringNameTransformer::getcamelCasedString($item, true).PHP_EOL;
//         }
        $this->assertSame(1,1);
        //var_dump($decoded);

    }

    }


 