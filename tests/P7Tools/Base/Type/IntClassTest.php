<?php
/**
 * P7Tools\Base\Data\ContainerTest
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
use P7Tools\Base\Type\IntClass;

class IntClassTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Testing, basic functionality
     * 
     */
    public function testBasix()
    {
        $i = new IntClass(3);
        $dta = $i->upTo(99);
        $this->assertInstanceOf('Generator', $dta);

        $f = new IntClass(100);
        $dta = $f->downTo(9);        
        $this->assertInstanceOf('Generator', $dta);
        $this->assertTrue(is_int($i->get()));
        $this->assertTrue(is_int($f->get()));
       
    }
}


