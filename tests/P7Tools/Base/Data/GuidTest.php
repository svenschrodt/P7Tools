<?php
/**
 * Application\GuidTest.php
 *
 * @since 12.08.2016
 * @author P290691 Sven Schrodt<Sven.Schrodt@mode-it-systems.de>
 * @version 0.0.24
 */
namespace P7Tools\Base\Data;

class GuidTest extends \PHPUnit\Framework\TestCase
{

    public function testCreation()
    {
       for($i=0;$i<2100;$i++) {
           $number = Guid::getRandomGUID() ;
//            echo $number . PHP_EOL;
           $this->assertTrue(strlen($number)==32);
       }
    }

}