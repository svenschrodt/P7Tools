<?php
/**
 * P7Tools\Database\Sql\Where
 * 
 * Representing WHERE clause 
 *
 * convention by default:
 *
 * - return null on unset data
 * - no ttl, but possible to be updated
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-11
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>*/

namespace P7Tools\Database\Sql;

use P7Tools\Dev\CodeCreator;
use P7Tools\Database\Sql\Query;

class Where implements \Iterator, \Countable // @TODO extends FOO extends Query
{

    /**
     * Array with conditions to be concatenated in WHERE clause
     */
    protected $_conditions = [];

    /**
     * Type of conditions to be concatenated 
     * 
     * @var string
     */
    protected $_concatConditionsWith = Query::OP_AND;

    /**
     * Costructor function 
     */
    public function __construct()
    {

    }

    
    public function add($conditions, $optional = false)
    {
        if (is_array($conditions)) {
            foreach ($conditions as $condition) {
                $this->_conditions[] = CodeCreator::parenthesiseExpression($condition);
            }
        } else {
            $this->_conditions[] = CodeCreator::parenthesiseExpression($conditions);
        }
    }

    public function addOr($conditions)
    {
        if (!count($this->_conditions)) {
            throw new SqlException(SqlException::NO_CONDITION_FOUND_YET);
        }
        $lastCondition = trim(array_pop($this->_conditions),'()');
        if(is_array($conditions)) {
            array_unshift($conditions, $lastCondition);
            $this->_conditions[] = implode(Query::OP_OR, $conditions);
        } else {
            $this->_conditions[] = CodeCreator::parenthesiseExpression(implode(Query::OP_OR, array($lastCondition, $conditions)));
        }
    }

    public function addAnd($conditions)
    {
        if (!count($this->_conditions)) {
            throw new SqlException(SqlException::NO_CONDITION_FOUND_YET);
        }
        $lastCondition = trim(array_pop($this->_conditions),'()');
        if(is_array($conditions)) {
            array_unshift($conditions, $lastCondition);
            $this->_conditions[] = implode(Query::OP_AND, $conditions);
        } else {
            $this->_conditions[] = CodeCreator::parenthesiseExpression(implode(Query::OP_AND, array($lastCondition, $conditions)));
        }
    }

    public function setConcatType($type)
    {
        //@TODO validate
        $this->_concatConditionsWith = $type;
    }

    public function __toString()
    {
        return Query::WHERE .' ' . implode($this->_concatConditionsWith, $this->_conditions);
    }

    // The following functions implement interface \Iterator making it possible
    // to iterate container objects with foreach

    /**
     * Resetting pointer to first array element
     */
    public function rewind()
    {
        reset($this->data);
    }

    /**
     * Getting current element
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * Getting key of current element
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     *
     * @return mixed|void
     */
    public function next()
    {
        return next($this->data);
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

    /**
     * Returning number of elements
     *
     * @return bool
     */
    public function count()
    {
        return count($this->_conditions);
    }
}
