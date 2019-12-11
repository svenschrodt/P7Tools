<?php
/**
 */
use P7Tools\Base\Data\BitMask;

class BitMaskTest extends \PHPUnit\Framework\TestCase
{

    public function testIfFilterWorksCorrectly()
    {
        $mask = new BitMask(64);
        $mask->setBit(3);
        $maxIndexOfBit = 63;
        for($i=0;$i<$maxIndexOfBit;$i++) {
            $mask = new BitMask($maxIndexOfBit);
            $mask->setBit($i);
            $this->assertTrue($mask->getDecimal() === pow(2, $i));
        }
//         $sep = 1;
//         echo PHP_EOL;
//         echo 'Staring ..';
//         echo PHP_EOL;
//         for($a=0;$a<256;$a++) {
//             echo sprintf("%08b", $a);
//             echo ' ';
//             if($sep % 14==0)
//             {
//                 echo PHP_EOL;
//             }
            
            
//             $sep++;
//         }
            

//         var_dump($mask);
//         echo $mask;
//         echo PHP_EOL;
//         echo decbin(8);
//         echo PHP_EOL;
        
//         echo decbin(16384-1);
//         echo PHP_EOL;
//         echo decbin(16384);
//         echo PHP_EOL;
//         $this->assertTrue(2===2*1);
//         echo $mask->getMaskTwo();
//         echo PHP_EOL;
//         echo $mask->getMaskTwo();
//         echo PHP_EOL;
    }
}


