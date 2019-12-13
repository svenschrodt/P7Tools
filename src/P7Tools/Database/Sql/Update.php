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

class Update extends Query
{

    /**
     * Constructor function 
     * 
     * @param array $columns
     * @param string $entity
     */
    public function __construct(array $columns = array(" * "), string $entity)
    {
        if (! is_null($entity)) {
            $this->_entity = $entity;
        }

        $this->_columns = $columns;
        $this->_queryType = Query::UDPATE;
        parent::__construct($columns, $entity);
    }

    public function setConcatType($type)
    {
        $this->_where->setConcatType($type);
        return $this;
    }

    public function table($entity)
    {
        $this->_entity = $entity;
        return $this;
    }

    public function __toString()
    {
        $this->_validate();
        $parts = array();
        $parts[] = $this->_queryType;
        $parts[] = $this->_entity;
        $parts[] = Query::SET;
        $parts[] = (count($this->_columns) == 1 && isset($this->_columns[0]) && $this->_columns[0] == ' * ') ? $this->_columns[0] : CodeCreator::getAssignmentList($this->_columns, "'", true, ', ');

        if (count($this->_where)) {
            $parts[] = $this->_where;
        }

        return implode($this->_lineFinisher . ' ', $parts);
    }
}
