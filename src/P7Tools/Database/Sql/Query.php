<?php
/**
 * \P7Tools\Databse\Sql\Query
 * 
 * Abstract froundation class representing SQL query statement
 *
 * convention by default:
 *
 * - return null on unset data
 * - no ttl, but possible to be updated
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Database\Sql;

define('SQL_FUNCTION_FINISHER', ')' . PHP_EOL);

class Query
{
    /***
     * Constant definitions for SQL operations
     */
    
    // DDL 
    const CREATE = 'CREATE ';

    const ALTER = 'ALTER ';

    const DROP = 'DROP ';

    // DML
    const SELECT = 'SELECT ';

    const INSERT = 'INSERT INTO ';

    const VALUES = 'VALUES ';

    const UDPATE = 'UDPATE ';

    const DELETE = 'DELETE ';

    const SET = 'SET ';

    // DCL
    const GRANT = 'GRANT ';

    const REVOKE = 'REVOKE ';

    const FROM = ' FROM ';

    const IN = ' IN (';

    const GROUP_BY = ' GROUP BY ';

    const HAVING = ' HAVING ';

    const ORDER_BY = ' ORDER BY ';

    const WHERE = ' WHERE ';

    const BETWEEN = ' BETWEEN ';

    const OP_AND = ' AND ';

    const OP_OR = ' OR ';

    const OP_NOT = ' NOT';

    const FINISHER = SQL_FUNCTION_FINISHER;

    /**
     * Name of current entity ("table")
     * 
     * @var string
     */
    protected $_entity;

    /**
     * Name of entity joined with current entity
     * 
     * @var string
     */
    protected $_joinedEntity;

    /**
     * String representation of query itself
     * 
     * @var string
     */
    protected $_query;

    /**
     * Named type of query [INSERT|UPDATE|SELECT ...]
     * 
     * @var string
     */
    protected $_queryType;

    /**
     * Optional WHERE clause part of query
     * 
     * @var string 
     */
    protected $_where;

    
//     protected $_select;

    /**
     * Array containing name of columns used in current query
     * 
     * @var array
     */
    protected $_columns;

    /**
     * Last update of query string
     * 
     * @var string
     */
    protected $_last;

    /**
     * EOL string for query [opt.]
     * 
     * @var string
     */
    protected $_lineFinisher=PHP_EOL;

    
    public function __construct(array $columns = array('*'), string $entity)
    {
        $this->_columns = $columns;
        $this->_where = new Where();
    }

    /**
     * "Factory" for query of type SELECT
     * 
     * @param array $columns
     * @param string $entity
     * @return string
     */
    public function select(array $columns = array(" * "), $entity = null) : string
    {
        $this->_last = new Select($columns, $entity);
        return $this->_last;
    }

    /**
     * "Factory" for query of type INSERT 
     *
     * @param array $columns
     * @param string $entity
     * @return string
     */
    public function insert(array $columns, $entity = null)
    {
        $this->_last = new Insert($columns, $entity);
        return $this->_last;
    }

    /**
     * "Factory" for query of type UPDATE
     *
     * @param array $columns
     * @param string $entity
     * @return string
     */
    public function update(array $columns, $entity = null)
    {
        $this->_last = new Update($columns, $entity);
        return $this->_last;
    }

    /**
     * Setter function for FROM part 
     * 
     * @param string $entity
     * @return \P7Tools\Database\Sql\Query
     */
    public function from($entity) : string
    {
        $this->_entity = $entity;
        return $this;
    }

    public function __toString() : string
    {
        return $this->_last->__toString();
    }

    /**
     * 
     * @return bool
     */
    protected function _validate() :bool
    {
        // @TODO implement
        return true;
    }

    /**
     * Addig WHERE clause to query string 
     * 
     * @param string $clause
     * @return \P7Tools\Database\Sql\Query
     */
    public function where(string $clause) : Query
    {
        $this->_where->add($clause);
        return $this;
    }

    /**
     * Addig OR part to WHERE clasue part of query string 
     * @param unknown $conditions
     * @return \P7Tools\Database\Sql\Query
     */
    public function addOr(string $conditions) : Query
    {
        $this->_where->addOr($conditions);
        return $this;
    }

    public function setLineFinisher(string $finisher)
    {
        $this->_lineFinisher=$finisher;
        return $this;
    }
}