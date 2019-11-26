<?php declare(strict_types=1); declare(strict_types=1);
/**
 * Abstract class for array like behaviour on objects, making them
 * - iteratable, countable,
 *
 * @TODO (un) serialize
 *
 * @author Sven Schrodt
 * @since 2015-10-04
 */
namespace P7Tools\Base\Data;



abstract class MultiArrayObject implements \Iterator, \Countable
{
    /**
     *
     * @var array
     */
    protected $_data = array();
    /**
     * Resetting pointer to first array element
     */
    public function rewind()
    {
        reset($this->_data);
    }

    /**
     * Getting current element
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->_data);
    }

    /**
     * Getting key of current element
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->_data);
    }

    /**
     *
     * @return mixed|void
     */
    public function next()
    {
        return next($this->_data);
    }

    /**
     * Returning if current element is valid
     *
     * @return bool
     */
    public function valid()
    {
        return ($this->current() !== false);
    }

    // Implementing interface \Countable

    /**
     * Counting elements of current array
     *
     * @return number
     */
    public function count()
    {
        return count($this->_data);
    }
}
