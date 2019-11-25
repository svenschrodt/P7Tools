<?php declare(strict_types=1);

/**
 * Filter functions for arrays
 *
 * e.g. data of non sql sources like LDAP, Webservices etc.
 *
 * @author Sven Schrodt
 * @since 2015-10-04
 */
namespace P7Tools\Base\Data;

use P7Tools\Base\Data\ArrayValidator;
use P7Tools\Base\Data\ScalarHelper;

class ArrayFilter
{

    /**
     * Filter mode 'string begins with'
     *
     * analogue to: LIKE '{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_BEGINS = 1;

    /**
     * Filter mode 'String begins NOT with'
     *
     * analogue to: NOT LIKE '{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_BEGINS_NOT = 101;

    /**
     * Filter mode 'string begins with'
     *
     * analogue to: LIKE '{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_ENDS = 2;

    /**
     * Filter mode 'String begins NOT with'
     *
     * analogue to: NOT LIKE '{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_ENDS_NOT = 102;

    /**
     * Filter mode 'String contains'
     *
     * analogue to: LIKE '%{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_CONTAINS = 3;

    /**
     * Filter mode 'String contains not'
     *
     * analogue to: NOT LIKE '%{$value}%'
     *
     * @var int
     */
    const FILTER_MODE_CONTAINS_NOT = 103;

    /**
     * Filter mode 'is equal to'
     *
     * analogue to: = '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS = 4;

    /**
     * Filter mode 'is not equal to'
     *
     * analogue to: <> '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS_NOT = 104;

    /**
     * Filter mode 'greater than'
     *
     * analogue to: = '> {$value}'
     *
     * @var int
     */
    const FILTER_MODE_GREATER_THAN = 5;

    /**
     * Filter mode 'not greater than'
     *
     * analogue to: NOT > '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_GREATER_THAN_NOT = 105;

    /**
     * Filter mode 'less than'
     *
     * analogue to: > '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_LESS_THAN = 6;

    /**
     * Filter mode 'not less than'
     *
     * analogue to: NOT > '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_LESS_THAN_NOT = 106;

    /**
     * Filter mode 'greater than'
     *
     * analogue to: = '> {$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS_OR_GREATER_THAN = 7;

    /**
     * Filter mode 'not greater than'
     *
     * analogue to: NOT > '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS_OR_GREATER_THAN_NOT = 107;

    /**
     * Filter mode 'less than'
     *
     * analogue to: = '> {$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS_OR_LESS_THAN = 8;

    /**
     * Filter mode 'not less than'
     *
     * analogue to: NOT > '{$value}'
     *
     * @var int
     */
    const FILTER_MODE_EQUALS_OR_LESS_THAN_NOT = 108;

    /**
     * Filter mode 'between'
     *
     * analogue to: BETWEEN '{$value1}' AND '{$value2}'
     *
     * @var int
     */
    const FILTER_MODE_BETWEEN = 9;

    /**
     * Filter mode 'not between'
     *
     * analogue to: NOT BETWEEN '{$value1}' AND '{$value2}'
     *
     * @var int
     */
    const FILTER_MODE_BETWEEN_NOT = 109;

    /**
     * Filter mode 'in'
     *
     * analogue to: IN ('{$value1}', '{$value2}' ...)
     *
     * @var int
     */
    const FILTER_MODE_IN = 10;

    /**
     * Filter mode 'not in'
     *
     * analogue to: NOT IN ('{$value1}', '{$value2}' ...)
     *
     * @var int
     */
    const FILTER_MODE_IN_NOT = 110;

    /**
     * Filter mode 'maximum value'
     *
     * analogue to: max()
     *
     * @var int
     */
    const FILTER_MODE_MAX = 20;

    /**
     * Filter mode 'minimum value'
     *
     * analogue to: min()
     *
     * @var int
     */
    const FILTER_MODE_MIN = 21;

    /**
     * Filtering elements from two dimensional array, with
     * key $key having value corresponding to be filtered by $value.
     *
     *
     * Aggregation filters (min, max, etc.) ignore $value
     *
     * @param string $key
     * @param string $value
     * @param array $data
     * @param int $mode
     * @throws InvalidArgumentException
     * @return array
     */
    public static function filterArrayOfArrays($key, $value, array $data, $mode = self::FILTER_MODE_CONTAINS)
    {
        // mode BETWEEN needs array with keys 'from' and 'to'
        if ($mode == self::FILTER_MODE_BETWEEN) {
            $check = ArrayValidator::hasKeys($value, array(
                'from',
                'to'
            ));
            if (! $check) {
                $message = 'FILTER_MODE_BETWEEN needs $value as Array with keys "from" and "to"';
                throw new \InvalidArgumentException($message);
            }
        }

        // mode IN needs array
        if ($mode == self::FILTER_MODE_IN) {
            if (! is_array($value)) {
                $message = 'FILTER_MODE_IN needs $value as Array';
                throw new \InvalidArgumentException($message);
            }
        }

        // MIN and MAX -> doing sort and return first element
        if ($mode === self::FILTER_MODE_MAX) {
            ArraySorter::sortByKeyNumeric($data, $key, 'DESC');
            return array(
                array_shift($data)
            );
        }
        if ($mode === self::FILTER_MODE_MIN) {
            ArraySorter::sortByKeyNumeric($data, $key, 'ASC');
            return array(
                array_shift($data)
            );
        }

        $filtered = array();

        // iterate array and filter each child array if condition matches
        foreach ($data as $item) {

            if (! isset($item[$key])) {
                continue;
            }

            switch ($mode) {
                case self::FILTER_MODE_BEGINS:
                    if (ValueValidator::begins($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_BEGINS_NOT:
                    if (! ValueValidator::begins($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_ENDS:
                    if (ValueValidator::ends($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_ENDS_NOT:
                    if (! ValueValidator::ends($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_CONTAINS:
                    if (ValueValidator::contains($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_CONTAINS_NOT:
                    if (! ValueValidator::contains($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_EQUALS:
                    if (ValueValidator::equals($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_EQUALS_NOT:
                    if (! ValueValidator::equals($item[$key], $value)) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_GREATER_THAN:
                    if ($item[$key] > $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_GREATER_THAN_NOT:
                    if (! $item[$key] > $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_LESS_THAN:
                    if ($item[$key] < $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_LESS_THAN_NOT:
                    if (! $item[$key] < $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_EQUALS_OR_GREATER_THAN:
                    if ($item[$key] >= $value) {
                        $filtered[] = $item;
                    }
                    break;
                case self::FILTER_MODE_EQUALS_OR_GREATER_THAN_NOT:
                    if (! $item[$key] >= $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_EQUALS_OR_LESS_THAN:
                    if ($item[$key] <= $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_EQUALS_OR_LESS_THAN_NOT:
                    if (! $item[$key] <= $value) {
                        $filtered[] = $item;
                    }
                    break;

                case self::FILTER_MODE_BETWEEN:
                    if (ValueValidator::isBetween($item[$key], $value['from'], $value['to']))
                        $filtered[] = $item;
                    break;

                case self::FILTER_MODE_BETWEEN_NOT:
                    if (! ValueValidator::isBetween($item[$key], $value['from'], $value['to']))
                        $filtered[] = $item;
                    break;

                case self::FILTER_MODE_IN:
                    if (ValueValidator::isIn($item[$key], $value, true))
                        $filtered[] = $item;
                    break;

                case self::FILTER_MODE_IN_NOT:
                    if (! ValueValidator::isIn($item[$key], $value, true))
                        $filtered[] = $item;
                    break;
            }
        }
        return $filtered;
    }

    /**
     * Getting valid filter modes
     *
     * @return array:
     */
    public static function getValidModes()
    {
        $rC = new \ReflectionClass(__CLASS__);
        return $rC->getConstants();
    }

    /**
     * Getting constant names of valid filter modes
     *
     * @return array:
     */
    public static function getFilterNames()
    {
        $rC = new \ReflectionClass(__CLASS__);
        return array_flip($rC->getConstants());
    }
}