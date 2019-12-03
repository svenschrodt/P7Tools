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
        echo $s . PHP_EOL;
        $s->toCamelCase(false, ' ');
        $this->assertSame('helloWorldHere-WeAre!', (string) $s);
        $s->toLowerCase();
        $this->assertSame('helloworldhere-weare!', (string) $s);
        
        $f = new StringClass('');
    }


}


