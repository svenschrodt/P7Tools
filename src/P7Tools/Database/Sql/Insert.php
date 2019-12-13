<?php
/**
 * P7Tools\Database\Sql\Insert
 * 
 * Representing INSERT statements with option WHERE - clause etc.
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

class Insert extends Query
{

    /**
     * Constructor function 
     * 
     * @param array $columns
     * @param null | P7Tools\Database\Sql\Query $entity
     */
    public function __construct(array $columns, string $entity )
    {
        $this->_columns = $columns;
        $this->_queryType = Query::INSERT;
        parent::__construct($columns, $entity);
    }

    public function into($entity)
    {
        $this->_entity = $entity;
        return $this;
    }

    public function __toString() : string
    {
        $this->_validate();
        $parts = array();
        $parts[] = $this->_queryType;
        $parts[] = $this->_entity;
        $parts[] = CodeCreator::parenthesiseExpression(CodeCreator::getEnumeration(array_keys($this->_columns), ''));
        $parts[] = Query::VALUES;
        $parts[] = CodeCreator::parenthesiseExpression(CodeCreator::getEnumeration($this->_columns));
        return implode($this->_lineFinisher . ' ', $parts);
    }
}
