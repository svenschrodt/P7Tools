<?php
/**
 * P7Tools\Mvc\ApplicationTest
 *
 * @deprecated -> applicatio wll be rwritten completly
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Mvc;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    protected $application;

    public function setUp() : void
    {
    }


    public function testDummyToSuppressWarning()
    {
        $this->assertTrue(is_string('Baz'));
        
    }
}