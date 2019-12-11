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
use P7Tools\Html\Text;

class ElementTest extends TestCase
{

    public function testIfBasicElementGenerationWorks()
    {
        
        $ele = new Element('h1');
        $ele->addClass('Foo');
        $ele->addClass('Baz');
        $ele->addClass('BAr');
        $ele->setId('UniqName');
        $txt = new Text('Test');
        $ele->addContent($txt);
        $this->assertInstanceOf('P7Tools\Html\Element', $ele);
        $this->assertInstanceOf('P7Tools\Html\Text', $txt);
        $this->assertInstanceOf('P7Tools\Html\Node', $ele);
        $this->assertInstanceOf('P7Tools\Html\Node', $txt);
        
//         echo PHP_EOL;
//         echo $ele;
//         echo PHP_EOL;
        
        $txt = ' I am blinky';
        $foo = new Element('span');
        $foo->addContent($txt)->addClass('blink');
        $ele->addContent($foo);
//         $this->assertSame((string) $foo, $txt);
//         echo PHP_EOL;
//         echo var_dump($foo);
//         echo PHP_EOL;
        
    }
}
    
    
    