<?php
/**
 * P7Tools
 *
 * Testing, if PHPUnit is working
 * 
 * Used for q&d tests
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
use P7Tools\Html\Element;

class ElementTest extends TestCase
{

    public function testIfBasicElementGenerationWorks()
    {
        
        $ele = new Element('h1');
        $ele->addClass('Foo');
        $ele->addClass('Baz');
        $ele->addClass('BAr');
        $ele->setId('UniqName');
        $ele->addContent('Test');
        echo $ele;
        echo PHP_EOL;
        $this->assertTrue(3 - 2 == 1);
        
    }
}
    
    
    