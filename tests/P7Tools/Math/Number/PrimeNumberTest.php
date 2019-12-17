<?php
/**
 * P7Tools\Http\CooperationTest
 *
 * Testing co operating of HTTP components
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools;

use P7Tools\Math\Number\PrimeNumberFactory;

class PrimeNumberTest extends \PHPUnit\Framework\TestCase
{

    public function testSieve()
    {
        $f = new PrimeNumberFactory();
        $d = $f->sieveofEratosthenes(55);
        $this->assertTrue(is_array($d));
        
    }
}
