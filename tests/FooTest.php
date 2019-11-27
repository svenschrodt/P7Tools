<?php
/**
 * P7Tools
 *
 * Testing, if PHPUnit is working
 * 
 * Used for q&d test 
 * 
 * @todo delete in ¹st stable version
 * 
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{

    public function testIfPhpUnitBootstrappingWorksFoo()
    {
        $this->assertTrue(2 * 1 == 2);
        $this->assertTrue(3 - 2 == 1);
        $this->expectException('P7Tools\Base\File\Exception');
        $bar = new \P7Tools\Foo();
        unset($bar);
        

        
    }
}
    
    
    