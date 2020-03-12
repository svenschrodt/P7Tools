<?php
declare(strict_types = 1);
/**
 * \P7Tools\Tools\ReverseEngineering\MysqlStructure
 *
 * Class helping to reverse engineer and get meta information about
 * MySQL ( || drop-in replacement RDBM like MariaDB, Percona ..) data base structures
 *
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-03
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Tools\ReverseEngineering;

use P7Tools\Database\MysqlAdapter;

class MysqlStructure
{

    /**
     * Mysql adapter instance
     *
     * @var null | \P7Tools\Database\MysqlAdapter
     */
    protected $_adapter = null;

    /**
     * Generic constructor function
     *  
     * @todo implementing option handling
     * @param array $options
     */
    public function __construct(array $options =[])
    {
        // if count(($options)) ..
        $this->_adapter = MysqlAdapter::getInstance();
    }

    /**
     * Getting list of entities in current data base schema
     * 
     * @return array
     */
    public function getEntities() : array
    {
        return $this->_getData('SHOW TABLES');
    }
    
    /**
     * Getting meta information on entity 
     * 
     * 
     * @param string $entity
     * @return array
     */
    public function getEntityStructure(string $entity) : array
    {
        return $this->_getData("DESCRIBE `{$entity}`", \PDO::FETCH_UNIQUE);
    }
    
    /**
     * Fetching data from server retrieved by query 
     * 
     * @param string $sql
     * @return array 
     */
    protected function _getData($sql, $style = \PDO::FETCH_COLUMN)
    {
        return $this->_adapter->query($sql)->fetchByStyle($style);     
    }
}
