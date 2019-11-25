<?php
/**
 * P7Tools\Mvc\ApplicationTest
 *
 *
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

    public function setUp()
    {
//         \P7Tools\Dev\Mock::setSuperGlobal();
//         $this->application = new Application();


        $password = "password";
        $iterations = 1000;

        // Generate a random IV using mcrypt_create_iv(),
        // openssl_random_pseudo_bytes() or another suitable source of
        // randomness
//         $salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

//         $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
//         echo $hash;
//         die;
    }

    public function testVersionConstantIsString()
    {
        $version = \P7Tools\Meta::VERSION;
        $this->assertTrue(is_string($version) && strlen($version) > 4);
    }

    /**
     * *
     * Testing correct version format (*.*.*)
     */
    public function testVersionConstantHasCorrectFormat()
    {
        $version = \P7Tools\Meta::VERSION;
        $result = explode('.', $version);
        $this->assertTrue(count($result) == 3);
    }

    public function NotestCanBeConstructedFromUppercaseString()
    {
        $this->assertInstanceOf('P7Tools\Mvc\Application', $this->application);
    }

    public function NOtestProperties()
    {
        $this->assertInstanceOf('P7Tools\Http\Request', $this->application->request);
        $this->assertInstanceOf('P7Tools\Http\Response', $this->application->response);
        $this->assertTrue(is_string($this->application->controller));
        $this->assertTrue(is_string($this->application->action));
        $this->assertTrue(is_array($this->application->params));
        $this->assertTrue(is_null($this->application->fooBarr));
        $this->assertTrue(is_string($this->application->getParam('Baz')));
        $this->assertTrue(is_null($this->application->getParam('fuzzyLogicVersusNeuronalNetworks')));
        $this->assertInstanceOf('P7Tools\Mvc\FrontController', $this->application->run());
    }
}