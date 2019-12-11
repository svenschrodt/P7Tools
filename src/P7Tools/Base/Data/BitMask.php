<?php
declare(strict_types = 1);
/**
 * P7Tools\Base\Data\BitMask
 *
 * Base class for working with bit masks
 *
 * @todo - rename to BitMaskArray
 *       - implement abstract BitMask
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-11
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
    const DEFAULT_BIT_WIDTH = 32;

    /**
     * Decimal value of current BitMask
     *
     * @var integer
     */
    protected $_decimalValue = 0;

    /**
     * Variable containing bit width of current instance
     *
     * @var integer
     */
    protected $_bitWidth = 32;

    /**
     * Array containing 0|1 values for each bit
     * 
     * @var array
     */
    protected $_mask = [];
    
    /**
     * Consructor function
     *
     * Initializing Mask's bits with 0
     */
    public function __construct(int $bits = self::DEFAULT_BIT_WIDTH)
    {
        $this->_mask = array_fill(0, $bits, 0);
    }

    /**
     * *
     * Setting bit with index (to 1)
     *
     * @param int $number
     */
    public function setBit(int $number)
    {
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

    public function     getDecimal()
    {
        return $this->_decimalValue;
    }
}
?>
