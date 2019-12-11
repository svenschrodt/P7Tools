<?php
declare(strict_types = 1);
/**
 * *
 * P7Tools\Base\Data\BitMask
 *
 * Base class for working with 32-bit (fixed-wide) masks
 * 
 * @todo total refactoring
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 *           
 */
namespace P7Tools\Base\Data;

class BitMask
{

    /**
     * Fix-width of bit mask
     *
     * @var integer
     */
    const INTEGER_LENGTH = 32;

    /**
     * [Array] index of MSB (most significant bit)
     *
     * @var integer
     */
    const MAX_BIT_INDEX = 31;

    // helper array for bitwise printed values
    // @deprecated
    protected $_mask;

    protected $_decimalValue = 0;

    /**
     * Consructor function
     *
     * Initializing Mask's bits with 0
     */
    public function __construct()
    {
        $this->_mask = array_combine(range(0, self::MAX_BIT_INDEX), array_fill(0, self::INTEGER_LENGTH, 0));
    }

    /***
     * Setting bit with index (to 1)
     * 
     * @param unknown $number
     */
    public function setBit($number)
    {
        // $this->_mask[self::MAX_BIT_INDEX - $number] = 1;
        $this->_mask[$number] = 1;
        $this->_decimalValue |= pow(2, $number);
    }

    public function removeBit($number)
    {
        // $this->_mask[self::MAX_BIT_INDEX - $number] = 0;
        $this->_mask[$number] = 0;
        $this->_decimalValue &= ~ pow(2, $number);
    }

    public function invertBit($number)
    {
        // if($this->_mask[self::MAX_BIT_INDEX - $number] == 0) {
        if ($this->_mask[$number] == 0) {
            $this->setBit($number);
        } else {
            $this->removeBit($number);
        }
    }

    public function __toString()
    {
        return '[' . $this->getMask() . '] ' . sprintf('%12s', $this->getDecimal());
    }

    public function getMask()
    {
        return sprintf("%032b", $this->_decimalValue);
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
