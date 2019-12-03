<?php declare(strict_types=1);

/**
 * \P7Tools\Base\Data\ArrayHandler 
 * 
 * Class handling fluent operations on multi dimensional arrays
 * with optional history and undo functionality
 *
 * Inline example
 * <code>
 * $ah = new ArrayHandler($data);
 * $ah->begins('name' , 'Fr') // filtering element with key 'name' begings with 'Fr'
 *    ->sort('id', 'DESC'); // sorting by element with key 'id' descending
 *
 * //undo two last operations and filtering element with key 'id' maximum value
 * $ah->rollBack()->rollBack()->max('account')
 *    ->sort('id', 'DESC');
 * </code>
 *
 * @author Sven Schrodt
 * @since 2015-10-02
 */
namespace P7Tools\Base\Data;

class ArrayHandler extends MultiArrayObject
{

    // @TODO implement history on|off switch
    
    /**
     * Flag value controlling manipulation history is used   
     * 
     * @var integer
     */
    const HISTORY_MODE_ON = 0;

    /**
     * Flag value controlling manipulation history is NOT used
     * 
     * @var integer
     */
    
    const HISTORY_MODE_OFF = 1;

    /**
     * Flag for debugging information 
     * 
     * Set to false on production boxes
     * 
     * @var bool
     */
    protected $_debug = true;

    /**
     * Internal representation of data
     *
     * @var array
     */
    protected $_data = array();

    /**
     * Internal pointer to current 'state of operation' of array
     *
     * @var int
     */
    protected $_current = 0;

    /**
     * Setting options
     *
     * @param array $options
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function setOptions(array $options) : ArrayHandler
    {
        // @TODO implement
        return $this;
    }

    /**
     * Sorting elements with key $key numerically or aplhabetically
     * depending on type
     *
     * @param string $key
     * @param string $direction
     * @param string $type
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function sort(string $key, string $direction = 'asc', string $type = 'numeric') : ArrayHandler
    {
        $tmp = $this->getCurrent();
        // @TODO switch by type
        if ($type == 'numeric') {
            ArraySorter::sortByKeyNumeric($tmp, $key, $direction);
        } else {
            ArraySorter::sortByKeyAlpha($tmp, $key, $direction);
        }
        // increase counter
        $this->_current ++;
        $this->_data[$this->_current] = $tmp;
        return $this;
    }

    /**
     * Sorting by part of value, separated by ' '
     *
     * @param string $key
     * @param number $part
     * @param string $direction
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function sortNamePart($key, $part = 1, $direction = 'asc')
    {
        $tmp = $this->getCurrent();
        ArraySorter::sortByKeyPartOfValue($tmp, $key, $direction);
        $this->_current ++;
        $this->_data[$this->_current] = $tmp;
        return $this;
    }

    /**
     * Getting current array
     *
     * @return array
     */
    public function getCurrent()
    {
        return $this->_data[$this->_current];
    }

    /**
     * Getting current element
     *
     * @return array
     */
    public function getCounter()
    {
        return $this->_current;
    }

    /**
     * Un doing last operation on array
     *
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function rollBack()
    {
        // no operation yet?
        if ($this->_current == 0) {
            return $this;
        }
        // deleting current array and decrementing counter
        unset($this->_data[$this->_current]);
        $this->_current --;
        return $this;
    }

    /**
     * Internal function to clear all Operations, but keep a certain state
     * representated by number $keep
     *
     * @param number $keep
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    protected function clearBut($keep = 0)
    {
        if (! array_key_exists($keep, $this->_data)) {
            throw new \InvalidArgumentException('Undefinded index ' . $keep);
        }
        //var_dump($this->_data);die;
        $tmp = $this->_data[$keep];
        $this->_current = 0;
        unset($this->_data);
        $this->_data = array($tmp);
        return $this;
    }

    /**
     * Deleting historical arrays, only keeping current
     *
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function clearHistory()
    {
        return $this->clearBut($this->_current);
    }

    /**
     * Deleting all operations, keeping original data
     *
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function clearOperations()
    {
        return $this->clearBut();
    }

    /**
     * Internal function applying different filters on current array
     *
     * @param string $key
     * @param mixed $value
     * @param string $mode
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    protected function applyFilter($key, $value, $mode)
    {
        $tmp = $this->getCurrent();
        $this->_current ++;
        $this->_data[$this->_current] = ArrayFilter::filterArrayOfArrays($key, $value, $tmp, $mode);
        return $this;
    }

    /**
     * Filter mode contains
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function contains($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_CONTAINS);
    }

    /**
     * Filter mode contains not
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notContains($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_CONTAINS_NOT);
    }

    /**
     * Filter mode begins
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function begins($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_BEGINS);
    }

    /**
     * Filter mode begins
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notBegins($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_BEGINS_NOT);
    }

    /**
     * Filter mode ends
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function ends($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_ENDS);
    }

    /**
     * Filter mode begins
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notEnds($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_ENDS_NOT);
    }

    /**
     * Filter mode equals
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function equals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS);
    }

    /**
     * Filter mode equals not
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function NotEquals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS_NOT);
    }


    /**
     * Filter mode greater than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function greater($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_GREATER_THAN);
    }

    /**
     * Filter mode not greater than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notGreater($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_GREATER_THAN_NOT);
    }

    /**
     * Filter mode less than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function less($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_LESS_THAN);
    }

    /**
     * Filter mode not less than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notLess($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_LESS_THAN_NOT);
    }

    /**
     * Filter mode greater or equals than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function greaterEquals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS_OR_GREATER_THAN);
    }

    /**
     * Filter mode not greater than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notgreaterEquals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS_OR_GREATER_THAN_NOT);
    }

    /**
     * Filter mode less than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function lessEquals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS_OR_LESS_THAN);
    }

    /**
     * Filter mode not less than
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notLessEquals($key, $value)
    {
        return $this->applyFilter($key, $value, ArrayFilter::FILTER_MODE_EQUALS_OR_LESS_THAN_NOT);
    }

    /**
     * Filter mode equals
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function between($key, $from, $to)
    {
        return $this->applyFilter($key, array(
            'from' => $from,
            'to' => $to
        ), ArrayFilter::FILTER_MODE_BETWEEN);
    }

    /**
     * Filter mode equals
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function notBetween($key, $from, $to)
    {
        return $this->applyFilter($key, array(
            'from' => $from,
            'to' => $to
        ), ArrayFilter::FILTER_MODE_BETWEEN_NOT);
    }



    /**
     * Filter mode max
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function max($key)
    {
        return $this->applyFilter($key, null, ArrayFilter::FILTER_MODE_MAX);
    }

    /**
     * Filter mode min
     *
     * @param string $key
     * @param string $value
     * @return \P7Tools\Base\Data\ArrayHandler
     */
    public function min($key)
    {
        return $this->applyFilter($key, null, ArrayFilter::FILTER_MODE_MIN);
    }



    /**
     * Generic constructor
     *
     * @param array $data
     * @param string $options
     */
    public function __construct(array $data = array(), $options = false)
    {
        $this->_data[] = $data;
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * 'Magical' interceptor giving string represantation of current element
     */
    public function __toString()
    {
        return ArrayHelper::getMultiArrayAsString($this->getCurrent(),$this->_debug);
    }

    // The following functions implement interface \Iterator making it possible
    // to iterate container objects with foreach
}