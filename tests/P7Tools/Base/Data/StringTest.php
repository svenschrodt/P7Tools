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

class StringTest extends \PHPUnit\Framework\TestCase
{



    public function setUp() : void
    {
    }


    public function testNetstring()
    {
        $string = 'hello world we are here !';
        $nets= new NetString();
        $nets->encodeString($string);
        $parser = new NetStringParser();
        $decoded = $parser->decode($nets->encoded);
        $this->assertSame($decoded->payload[0], $string);
        //var_dump($decoded);

    }

    public function testIfPathWillGeneratedCorrectly()
    {
        $path = \P7Tools\Base\Data\StringClass::getFilePathFromParts(array('a','b', 'd'));
        $manualPath = 'a'. DIRECTORY_SEPARATOR . 'b' . DIRECTORY_SEPARATOR . 'd';
        $this->assertEquals(strtoupper('foo'), 'FOO');
        $this->assertEquals($path, $manualPath);

    }
}


