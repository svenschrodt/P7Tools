<?php declare(strict_types=1);
/**
 * Abstract base class for working with bit based flags
 * 
 * 
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net> *
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