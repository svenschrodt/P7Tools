<?php
/**
 * \Cache\Filecache
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

    protected $_entity;

    protected $_joinedEntity;

    protected $_query;

    protected $_queryType;

    protected $_where;

    protected $_select;

    protected $_columns;

    protected $_last;

    protected $_lineFinisher=PHP_EOL;

    public function __construct(array $columns = array('*'), $entity = null)
    {
        if (! is_null($entity)) {
            $this->_entity = $entity;
        }
        $this->_columns = $columns;
        $this->_where = new Where();
    }

    public function select(array $columns = array(" * "), $entity = null)
    {
        $this->_last = new Select($columns, $entity);
        return $this->_last;
    }

    public function insert(array $columns, $entity = null)
    {
        $this->_last = new Insert($columns, $entity);
        return $this->_last;
    }

    public function update(array $columns, $entity = null)
    {
        $this->_last = new Update($columns, $entity);
        return $this->_last;
    }

    public function from($entity)
    {
        $this->_entity = $entity;
        return $this;
    }

    public function __toString()
    {
        return $this->_last->__toString();
    }

    protected function _validate()
    {
        // @TODO implement
        return true;
    }

    public function where($clause)
    {
        $this->_where->add($clause);
        return $this;
    }

    public function addOr($conditions)
    {
        $this->_where->addOr($conditions);
        return $this;
    }

    public function setLineFinisher($finisher)
    {
        if(!is_string($finisher)) {
            //@TODO validation
        }
        $this->_lineFinisher=$finisher;
        return $this;
    }
}