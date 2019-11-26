<?php
/**
 * P7Tools\Base\Data\ContainerTest
 *
 * Testing, if PHPUnit is working
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
    }
}
    
    
    