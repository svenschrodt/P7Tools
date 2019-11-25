<?php
namespace P7Tools\Database;
use TestApp\Models\Glossary;
use P7Tools\Base\File\Config;
class MySqlHelper
{
    private $dbh, $stmt;

    private $entityClassName = 'TestApp\Models\Glossary';

    /**
     *
     * @var DatabaseHelper | null $instance
     */
    private static $instance = null;




    /**
     * Getter for static instance (Singleton)
     *
     * @return GlossaryManager
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }


    private  function __construct()
    {
        /* Connect to an ODBC database using driver invocation */
        //@TODO bring this to config!!

        $config = Config::getConfig('db');
        //@TODO validate if(!isset())
//         $dsn = 'mysql:dbname=zf2_test_schrodt;host=entw3.puc';
//         $user = 'root';
//         $password = 'xvf192g';

        if(! \P7Tools\Base\Data\ArrayValidator::hasKeys($config, array('dsn', 'user', 'password'))) {
            throw new \P7Tools\Base\File\Exception(\P7Tools\Base\File\Exception::CONFIG_FILE_INFO_MISSING .  ' db auth and / or connection');
        }
        try {
            $this->dbh = new \PDO($config['dsn'], $config['user'], $config['password']);
            $this->dbh->query('SET NAMES utf8');
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }


    /**
     * Executing sql statements
     *
     * @param unstring $sql
     * @return \P7Tools\Database\Helper
     */
    public function query($sql)
    {
        if(!$this->stmt = $this->dbh->query($sql)) {
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

    public function insert($sql)
    {

        $stmt = $this->dbh->query($sql);
        $lastId =  $this->dbh->lastInsertId();
        return (int) $lastId;
    }

    /**
     * Fetching row(s)
     *
     * @param string $class
     * @return array
     */
    public function fetch($class=null)
    {
        if(is_null($class)) {
            $class=$this->entityClassName;
        }
       // die($class);
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }


    /**
     * Quoting string for sql statement
     *
     * @param string $string
     * @return string
     */
    public function quote($string)
     {
         return $this->dbh->quote($string);
    }

}