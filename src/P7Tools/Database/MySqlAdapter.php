<?php declare(strict_types=1);
/**
 * \P7Tools\Database\MysqlAdapter 
 * 
 * Adapter for Mysql PDO functionality
 *  
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-01
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Database;

use P7Tools\Base\File\Config;

class MySqlAdapter
{

    /**
     * Data base handle of type PDO
     *
     * @see https://www.php.net/manual/de/book.pdo.php
     * @var \PDO
     */
    private $_dbh = null;

    /**
     * Instance holding representation of current statement for adapter
     *
     * @see https://www.php.net/manual/de/class.pdostatement.php
     * @var \PDOStatement
     */
    private $_stmt;

    /**
     * Static member for (singleton) instance of current PDO adapter
     * 
     * @var MySqlAdapter | null 
     */
    private static $_instance = null;

    /**
     * Name of default class holding fetched results
     *
     * @var string
     */
    private $_dataContainer = 'stdClass';

    /**
     * Auto increment ID of last INSERT statement
     * 
     * @var integer
     */
    private $_lastId = 0;
    
    /**
     * Getter for static instance (Singleton)
     *
     * @return \P7Tools\Database\MysqlAdapter
     */
    public static function getInstance(): MysqlAdapter
    {
        if (is_null(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c();
        }
        return self::$_instance;
    }

    /**
     * Constructor function
     * 
     * - connecting to db server via this PDO adapter
     * - setting character encoding to UTF-8
     *
     * @throws \PdoException
     * @param array $config
     */
    private function __construct(array $config = [])
    {
        // Connect to database using driver invocation
        // @TODO validating existing needed array keys
        if (count($config) == 0) {
            $config = Config::getConfig('db');
        }
        /**
         * Creating dsn (data source name) connection string from config:
         * $TYPE:dbname=$NAME;host=$HOST
         * -e.g: mysql:dbname=my_db;host=db.example.org
         */
        $config['dsn'] = "{$config['type']}:dbname={$config['name']};host={$config['host']}";

        /**
         * Connecting to data base server and setting used character encodig as
         * UTF-8
         *
         * @see https://en.wikipedia.org/wiki/Data_source_name
         * @see https://en.wikipedia.org/wiki/UTF-8
         */
        try {
            $this->_dbh = new \PDO($config['dsn'], $config['user'], $config['pass']);
            $this->_dbh->query('SET NAMES utf8');
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Executing sql statement
     *
     * @param string $sql
     * @return \P7Tools\Database\MySqlAdapter
     */
    public function query(string $sql): MySqlAdapter
    {
        if (! $this->_stmt = $this->_dbh->query($sql)) {
            return false;
        }
        return $this;
    }

    /**
     * Executing Insert statement, returning inserted id
     *
     * @param string $sql
     * @return int
     */
    public function insert(string $sql): int
    {
        //@TODO -> getting INSERT statement dynamically from PHP data structures
        // and \P7Tools\Database\SQL\Query* classes
        $this->_stmt = $this->_dbh->query($sql);
        $this->_lastId = $this->_dbh->lastInsertId();
        return (int) $this->_lastId;
    }

    /**
     * Fetching row(s)
     *
     * @param string $class
     * @return array
     */
    public function fetch(string $class = '')
    {
        if ($class === '') {
            $class = $this->_dataContainer;
        }
        return $this->_stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * Quoting string for sql statement
     *
     * @param string $string
     * @return string
     */
    public function quote(string $string) : string
    {
        return $this->_dbh->quote($string);
    }
}