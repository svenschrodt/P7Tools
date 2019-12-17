<?php
/**
 */
use P7Tools\Base\Data\BitMask;

class BitMaskTest extends \PHPUnit\Framework\TestCase
{

    public function testIfBitMaskBuildingWorksCorrectly()
    {
        $mask = new BitMask(64);
        $mask->setBit(3);
        
        $this->assertTrue(8===$mask->getDecimal());
        
        $maxIndexOfBit = 63;
        for($i=0;$i<$maxIndexOfBit;$i++) {
            $mask = new BitMask($maxIndexOfBit);
            $mask->setBit($i);
            $this->assertTrue($mask->getDecimal() === pow(2, $i));
        }

    }
}


