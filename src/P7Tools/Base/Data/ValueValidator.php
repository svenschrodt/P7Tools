<?php declare(strict_types=1);
/**
 * Validation functions for given values
 *
 * @package P7Tools
 * @author Sven Schrodt
 * @since 2015-10-04
 */
namespace P7Tools\Base\Data;

class ValueValidator
{

    /**
     * Checking if $givenValue contains $expectedValue
     *
     * @param string $givenValue
     * @param string $expectedValue
     * @param array $data
     * @return boolean
     */
    public static function contains($givenValue, $expectedValue)
    {
        //  explicit casting
        $expectedValue = (string) $expectedValue;
        return (bool) strstr($givenValue, $expectedValue);
    }

    /**
     *  Checking if $givenValue begins with $expectedValue
     *
     * @param string $givenValue
     * @param string $expectedValue
     * @param array $data
     * @return boolean
     */
    public static function begins($givenValue, $expectedValue)
    {
        //  explicit casting
        $expectedValue = (string) $expectedValue;
        return (substr($givenValue, 0, strlen($expectedValue)) == $expectedValue);
    }

    /**
     *  Checking if $givenValue ends with $expectedValue
     *
     * @param string $givenValue
     * @param string $expectedValue
     * @param array $data
     * @return boolean
     */
    public static function ends($givenValue, $expectedValue)
    {
        //  explicit casting
        $expectedValue = (string) $expectedValue;
        return (substr($givenValue, -1 * strlen($expectedValue)) == $expectedValue);
    }

    /**
     * Checking if $givenValue is equal to $expectedValue
     *
     * @param string $givenValue
     * @param mixed $expectedValue
     * @param array $data
     * @return boolean
     */
    public static function equals($givenValue, $expectedValue)
    {
        return ($givenValue == $expectedValue);
    }

    /**
     * Checking if $givenValue is identical to $expectedValue
     *
     * @param string $givenValue
     * @param mixed $expectedValue
     * @param array $data
     * @return boolean
     */
    public static function isIdentical($givenValue, $expectedValue)
    {
        return ($givenValue === $expectedValue);
    }

    /**
     * Checking if $givenValue is in list of $expectedValue
     * By default this functions works in strict mode without
     * implicit type casting
     *
     * @param string $givenValue
     * @param mixed $expectedValue
     * @param array $data
     * @param boolean $strict
     * @return boolean
     */
    public static function isIn($givenValue, array $expectedValue, $strict=true)
    {
        return in_array($givenValue, $expectedValue, $strict);
    }

    /**
     * $Checking if $givenValue is between $from and $to
     *
     * @TODO implement for different Types like \DateTime etc.
     *
     * @param string $givenValue
     * @param mixed $from
     * @param mixed $to
     * @param array $data
     * @return boolean
     */
    public static function isBetween($givenValue, $from, $to)
    {
        if ($from > $to) {
            ScalarHelper::swapValues($from, $to);
        }
        return ($givenValue <= $to) &&
            ($givenValue >= $from);
    }
}