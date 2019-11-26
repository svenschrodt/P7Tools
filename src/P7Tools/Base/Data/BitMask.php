<?php declare(strict_types=1); declare(strict_types=1);
/***
 * Base class for working with 32 bit wide masks
 */
namespace P7Tools\Base\Data;

class BitMask
{

    const INTEGER_LENGTH = 32;
    const MAX_BIT_INDEX = 31;

    //helper array for bitwise printed values
    //@deprecated
    protected $_mask;

    protected $_decimalValue = 0;

    public function __construct()
    {
        $this->_mask = array_combine(range(0, self::MAX_BIT_INDEX), array_fill(0, self::INTEGER_LENGTH, 0));
    }

    public function setBit($number)
    {
       // $this->_mask[self::MAX_BIT_INDEX - $number] = 1;
        $this->_mask[$number] = 1;
        $this->_decimalValue |= pow(2, $number);
    }

    public function removeBit($number)
    {
//         $this->_mask[self::MAX_BIT_INDEX - $number] = 0;
        $this->_mask[$number] = 0;
        $this->_decimalValue &= ~ pow(2, $number);
    }

    public function invertBit($number)
    {
//         if($this->_mask[self::MAX_BIT_INDEX - $number] == 0) {
        if($this->_mask[$number] == 0) {
            $this->setBit($number);
        } else {
            $this->removeBit($number);
        }
    }


    public function __toString()
    {
        return'[' . $this->getMask() .'] ' .  sprintf('%12s',$this->getDecimal()) ;
    }

    public function getMask()
    {
      return sprintf("%032b",   $this->_decimalValue);

    }

    public function getMaskTwo()
    {
        return implode($this->_mask, '');
    }

    public function getDecimal()
    {
        return $this->_decimalValue;
    }
}
?>
