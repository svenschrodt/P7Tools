<?php declare(strict_types=1);
/**
 * P7Tools\Base\Data\MultiArrayObject
 *
 * Abstract class for array like behaviour on objects, making them
 * - iteratable, 
 * - countable,

 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.24
 */
 
namespace P7Tools\Base\Data;

abstract class MultiArrayObject implements \Iterator, \Countable
{

    /**
     * Resetting pointer to first array element
     */
    public function rewind()
    {
        reset($this->_data[$this->_current]);
    }

    /**
     * Getting current element
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->_data[$this->_current]);
    }

    /**
     * Getting key of current element
     *
     * @return string 
     */
    public function key()
    {
        return key($this->_data[$this->_current]);
    }

    /**
     *
     * @return mixed|void
     */
    public function next()
    {
        return next($this->_data[$this->_current]);
    }

    /**
     * Returning if current element is valid
     *
     * @return bool
     */
    public function valid() : bool
    {
        return ($this->current() !== false);
    }

    // Implementing interface \Countable

    /**
     * Counting elements of current array
     *
     * @return int
     */
    public function count() :int
    {
        return count($this->_data[$this->_current]);
    }
}
