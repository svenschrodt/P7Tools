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
use P7Tools\Mvc\Application;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    protected $application;

    public function setUp(): void
    {
        $httpContext = new \P7Tools\Tools\Mock\Context\Http();
        $this->application = new Application();
        $httpContext->setGetVars([
            'foo' => 'bar'
        ]);
    }

    public function testDummyToSuppressWarning()
    {
        $this->application->run();

        // var_dump($this->application);

        $this->assertTrue(is_string('Baz'));
    }
}