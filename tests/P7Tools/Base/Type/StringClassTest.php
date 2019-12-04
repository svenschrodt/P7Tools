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
use P7Tools\Base\Type\StringClass;

class StringClassTest extends \PHPUnit\Framework\TestCase
{



    /**
     * Testing, if case transformation is working correctly
     * 
     * 
     */
    public function testCaseTransforming()
    {
        $string = 'hello world here - we are !';
        $s= new StringClass($string);
        $s . PHP_EOL;
        $s->toCamelCase(false, ' ');
        $this->assertSame('helloWorldHere-WeAre!', (string) $s);
        $s->toLowerCase();
        $this->assertSame('helloworldhere-weare!', (string) $s);
        
        $f = new StringClass('');
    }


}


