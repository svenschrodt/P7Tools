<?php
/**
 * Basic testing of PHPUnit's functionality
 * 
 * 
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools;

class BasicTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function setUp(): void
    {}

    public function testTyping()
    {
        $a = 12;
        $b = 2.2345;
        $c = 'Lorem Ipsum';
        $d = (5 > 9);
        $data = [
            $a => gettype($a),
            $b => gettype($b),
            $c => gettype($c),
            $d => gettype($d)
        ];

        $keys = [
            2, 
            12,
            'Lorem Ipsum'
        ];
        $foo = new \stdClass();
        $this->assertTrue(gettype($a) === 'integer');
        $this->assertTrue(gettype($b) === 'double');
        $this->assertTrue(gettype($c) === 'string');
        $this->assertTrue(gettype($d) === 'boolean');
        $this->assertTrue(is_array($data));
        $this->assertTrue(is_object($foo));
        $this->assertInstanceOf('stdClass', $foo);
        foreach ($keys as $key) {
            $this->assertTrue(array_key_exists($key, $data));
        }
    }
}


