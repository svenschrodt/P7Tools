<?php declare(strict_types=1);
/**
 * P7Tools\Base\Data\Container
 *
 * Generic base container class to store, handle and manage
 * data and meta data:
 *
 * - using (magical) interceptor methods
 * - implementing interface \Iterator (supporting usage of foreach for non public members)
 *
 * Rules:
 *
 * - if P7Tools\Base\Data\Container::$validKeys is not empty, only properties with names
 *    contained in it are valid
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.24
 */
namespace P7Tools\Base\Data;


class Container implements \Iterator
{
    /**
     * Storing property names ('keys') -> if empty, all keys allowed
     *
     * @var array
     */
    protected $validKeys = array();

    /**
     * Holding  data
     *
     * @var array
     */
    protected $data = array();

    /**
     * Constructor function
     *
     * @param mixed $data
     */
    public function __construct($data = false, $allKeys = false)
    {
        // TODO handling different data types (objects, strings etc...)
        if ($data && is_array($data)) {
            $this->data = $data;
        }
    }

    /**
     * Interceptor called, when object will ve used in
     * context of a string. We will return a string serialized
     * representation of class instance.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->exportInstance();
    }

    /**
     * Returning property named $key, if existing
     *
     * @param $key
     * @return null
     */
    public function __get($key)
    {
        return (array_key_exists($key, $this->data)) ? $this->data[$key] : null;
    }

    /**
     * Setting property named $key, if existing
     *
     * @param $key
     * @return null
     */
    public function __set($key, $value)
    {
        if(!$this->isValidKey($key)) {
            throw new \InvalidArgumentException('Invalid Property ' . $key);
        }
        $this->data[$key] = $value;
    }

    /**
     * Testing, if property is set
     *
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Deleting property
     *
     * @param $key
     * @return bool
     */
    public function __unset($key)
    {
        if (isset($this->data[$key])) {
            unset ($this->data[$key]);
        }
    }


    /**
     * Magical interceptor -  for our friends of getter and setter functions:
     *
     * implementing 'virtual' setProperty and getProperty methods with
     *
     * Examples:
     *
     * getFirstName() -> returning value of property firstName
     * setLastName('Miller') -> setting value of property lastName to 'Miller'
     *
     * @param $name
     * @param $data
     * @throws \ErrorException
     */
    public function __call($name, $data)
    {
        // Getting type of called function (get | set)
        $type = strtolower(substr($name, 0, 3));

        //getting property name from called function
        $key = lcfirst(substr($name, 3));

        // check if optional parameter [for setter] is given
        if (isset($data[0])) {
            $argument = $data[0];
        };

        // TODO remove this after finishing development of P7Tools
        // @codeCoverageIgnoreStart
        if(\P7Tools\Mvc\Application::$showDebugInfo) {
            echo "$type called for $key";
            if (isset($argument)) {
                echo " with argument: '$argument'(" . gettype($argument) . ")";
            }
            echo "\n";
        }
        // @codeCoverageIgnoreEnd

        // calling actual getter | setter
        switch($type) {

            case 'get': //getter called?
                return $this->__get($key);
            break;

            case 'set': // setter called?
                if (!isset($argument)) {
                    throw new \InvalidArgumentException('missing argument for ' . $name . '()');
                }
                $this->__set($key, $argument);
                break;
            // @codeCoverageIgnoreStart
            default: // undefined function called?
                throw new \ErrorException('Call to undefined function '  .$name);
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * Checking if key is valid name for property
     *
     * @param $key
     * @return int
     */
    public function isValidKey($key)
    {
        if (count($this->validKeys) == 0) {
            // Container::$validKeys is empty, so every key is valid
            return true;
        } else {
            return in_array($key, $this->validKeys, true);
        }
    }

    /**
     * Setting valid keys  for current container instance
     *
     * @param array $keys
     */
    public function setValidKeys(Array $keys)
    {
        $this->validKeys = $keys;
    }

    /**
     * Returning valid keys / property names
     *
     * @param array $keys
     * @return array
     */
    public function getValidKeys()
    {
        return $this->validKeys;
    }

    /**
     * Returning existing keys / property names
     *
     * @return array
     */
    public function getExistingKeys()
    {
        return array_keys($this->data);
    }

    // the following functions support serializing and
    // un serializing of instances

    /**
     * Returning serialized string representation of current instance
     *
     * @return string
     */
    public function exportInstance()
    {
        return serialize($this);
    }

    /**
     * Importing serialized instance's state
     *
     * @param $string
     */
    public function importInstance($string)
    {
        $temp =  unserialize($string);
        $this->setValidKeys($temp->getValidKeys());
        $this->data = $temp->data;
    }

    // The following functions implement interface \Iterator making it possible
    // to iterate container objects with foreach

    /**
     * Resetting pointer to first array element
     *
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
     * @return mixed
     */
    public function key()
    {
        return key($this->data);
    }

    /**
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

}

