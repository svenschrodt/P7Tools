<?php declare(strict_types=1);
/**
 * Validation functions for arrays
 *
 * @package P7Tools
 * @author Sven Schrodt
 * @since 2015-10-04
 */
namespace P7Tools\Base\Data;

class ArrayValidator
{

    /**
     * Checking, if $data has every value of $keys as Key
     *
     * @param array $value
     * @param array $keys
     * @param string $checkType
     * @return boolean
     */
    public static function hasKeys(array $data, array $keys)
    {
        foreach ($keys as $key) {
            if (! array_key_exists($key, $data)) {
                return false;
            }
        }
        return true;
    }

    /**
     *
     * @param array $data
     * @param unknown $key
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public static function ensureKeyExistsDefaultValue(array &$data, $key, $type = 'int')
    {
        if (! is_string($key)) {
            throw new \InvalidArgumentException('$key MUST be string');
        }
        foreach ($data as &$item) {
            if (! is_array($item)) {
                throw new \Exception(__FUNCTION__ . ' only works on multio dimensional arrays');
            }
            if (! isset($item[$key])) {
                switch (strtolower($type)) {
                    case 'int':
                        $item[$key] = 0;
                        break;
                    case 'string':
                        $item[$key] = '';
                        break;
                    case 'float':
                        $item[$key] = (float) 0.0;
                        break;
                    case 'null':
                        $item[$key] = null;
                        break;
                    case 'array':
                        $item[$key] = array();
                        break;
                    default:
                        if (class_exists($type)) {
                            $reflectionClass = new \ReflectionClass($type);
                            if ($reflectionClass->IsInstantiable()) {
                                $item[$key] = new $type();
                            }
                        }
                }
            }
        }
    }
}