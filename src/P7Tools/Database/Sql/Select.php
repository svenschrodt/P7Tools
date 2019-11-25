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

use P7Tools\Dev\CodeCreator;

class Select extends Query
{

    protected $_orderBy;

    protected $_groupBy;

    protected $_limit;

    protected $_offset;

    public function __construct(array $columns = array(" * "), $entity = null)
    {
        if (! is_null($entity)) {
            $this->_entity = $entity;
        }

        $this->_columns = $columns;
        $this->_queryType = Query::SELECT;
        parent::__construct($columns, $entity);
    }

    public function setConcatType($type)
    {
        $this->_where->setConcatType($type);
        return $this;
    }

    public function from($entity)
    {
        $this->_entity = $entity;
        return $this;
    }

    protected function setClauseMultitype($field, $type = 'orderBy')
    {
        if (is_array($field)) {
            $field = implode(', ', $field);
        }
        switch ($type) {
            case 'orderBy':
                $this->_orderBy = $field;
                break;
            case 'groupBy':
                $this->_groupBy = $field;
                break;
        }
    }

    public function orderBy($field)
    {
        $this->setClauseMultitype($field, 'orderBy');
        return $this;
    }

    public function groupBy($field)
    {
        $this->setClauseMultitype($field, 'groupBy');
        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->_limit = $limit;
        $this->_offset = $offset;
        return $this;
    }

    public function __toString()
    {
        $this->_validate();
        $parts = array();
        $parts[] = $this->_queryType;
        $parts[] = (count($this->_columns) == 1 && isset($this->_columns[0]) &&
             $this->_columns[0] == ' * ') ? $this->_columns[0] : CodeCreator::getEnumeration(
                $this->_columns, '');
        $parts[] = Query::FROM;
        $parts[] = $this->_entity;
        if (count($this->_where)) {
            $parts[] = $this->_where;
        }
        // @TODO use
        if (! is_null($this->_groupBy)) {
            $parts[] = "GROUP BY {$this->_groupBy}";
        }
        if (! is_null($this->_orderBy)) {
            $parts[] = "ORDER BY {$this->_orderBy}";
        }
        if (! is_null($this->_limit)) {
            $parts[] = "LIMIT {$this->_offset} {$this->_limit}";
        }
        return implode($this->_lineFinisher . ' ', $parts);
    }
}
