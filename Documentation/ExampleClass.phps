<?php declare(strict_types = 1);

/**
 * \P7Tools\Base\Data\ArrayHandler
 *
 * Class handling fluent operations on multi dimensional arrays
 * with optional history and undo functionality
 *
 * Inline examples:
 * 
 * <code>
 * $ah = new ArrayHandler($data);
 * $ah->begins('name' , 'Fr') // filtering element with key 'name' begings with 'Fr'
 * ->sort('id', 'DESC'); // sorting by element with key 'id' descending
 *
 * //undo two last operations and filtering element with key 'id' maximum value
 * $ah->rollBack()->rollBack()->max('account')
 * ->sort('id', 'DESC');
 * </code>
 *
 * @fixme - repairing encoding line 109 ff
 * 
 * @todo - validating user input 
 * 
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
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
     * @used-by ArrayHandler::rollBack()
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
}

