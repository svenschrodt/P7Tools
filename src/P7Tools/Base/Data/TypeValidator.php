<?php declare(strict_types=1); declare(strict_types=1);

/**
 * Static validation methods for data types
 *
 * @author Sven Schrodt
 * @since 2015-04-11
 */
namespace P7Tools\Base\Data;

class TypeValidator
{

    /**
     * Checking for type and throwing \InvalidArgumentException
     * on mismatch
     *
     * @param mixed $value
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public static function validateAsType($value, $type = 'scalar')
    {
        if (! self::isType($value, $type)) {
            throw new \InvalidArgumentException("Type '$type' expected - '" . gettype($value) . "' given");
        }
    }

    /**
     * Checking, if $value is of type $type
     *
     * @param mixed $value
     * @param string $type
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function isType($value, $type)
    {
        if (! is_string($type)) {
            throw new \InvalidArgumentException("Type: $type string - " . gettype($value) . ' given');
        }


        switch (strtolower($type)) {
            case 'numeric':
            case 'num':
            case 'number':
                return is_numeric($value);
                break;

            case 'int':
            case 'integer':
                return is_int($value);
                break;

            case 'float':
            case 'double':
            case 'decimal':
                return is_float($value);
                break;

            case 'string':
                return is_string($value);
                break;

            case 'array':
                return is_array($value);
                break;

            case 'scalar':
                return is_scalar($value);
                break;

            case 'bool':
            case 'boolean':
                return is_bool($value);
                break;

            default:
                if (is_object($value)) {
                    return ($value instanceof $type);
                } else {
                    throw new \InvalidArgumentException("Unknown type '" . gettype($value)) - "'";
                }
        }
    }
}
