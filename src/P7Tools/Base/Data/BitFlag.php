<?php declare(strict_types=1);
/**
 * Abstract base class for working with bit based flags
 *
 *
 */

namespace P7Tools\Base\Data;
abstract class BitFlag
{
    protected $_flags;

    protected function isFlagSet($flag)
    {
        return (($this->_flags & $flag) == $flag);
    }

    protected function setFlag($flag, $value)
    {
        if($value)
        {
            $this->_flags |= $flag;
        }
        else
        {
            $this->_flags &= ~$flag;
        }
    }
}