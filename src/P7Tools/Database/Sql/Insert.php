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

class Insert extends Query
{



    public function __construct(array $columns, $entity = null)
    {
        if (! is_null($entity)) {
            $this->_entity = $entity;
        }

        $this->_columns = $columns;
        $this->_queryType = Query::INSERT;
        parent::__construct($columns, $entity);
    }


    public function into($entity)
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
        $parts[] =  CodeCreator::parenthesiseExpression(CodeCreator::getEnumeration(array_keys($this->_columns), ''));
        $parts[] = Query::VALUES;
        $parts[] =  CodeCreator::parenthesiseExpression(CodeCreator::getEnumeration($this->_columns));
        return implode($this->_lineFinisher . ' ', $parts);
    }
}
