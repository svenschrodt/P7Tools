<?php declare(strict_types=1);

/**
 * Static methods for sorting arrays of arrays
 *
 * @author Sven Schrodt
 * @since 2012-03-13
 */
namespace P7Tools\Base\Data;

class ArraySorter
{

    /**
     * Sort type for self::sortByKeyNumeric() || sortByKeyAlpha()
     * Default value as in SQL
     *
     * @var string
     */
    public static $sortOrder = 'asc';

    /**
     * Sort key for self::sortByKeyNumeric() || sortByKeyAlpha()
     *
     * @var string|null
     */
    public static $sortKey = null;

    /**
     * Separator, if sorting by part of values
     * e.g: "firstName LastName"
     * -> ' ' = separator
     *
     * @var string
     */
    public static $partSeparator = ' ';

    /**
     * Default value for part
     * [0] ^ [1]
     *     |_____________Separator
     *
     * @var int
     */
    public static $partOfValue = 1;

    /**
     * Sorting array by child key numerically
     *
     * Inline example
     * <code>
     * $data = array(array('id' => 23,
     * 'name' => 'Hagbard'),
     * array('id' => 88,
     * 'name' => 'Equals'),
     * array('id' => 42,
     * 'name' => 'Meaning of life'));
     * // sorting by id descending
     * Common_Helper_Array::sortByKey($data, 'id', 'desc');
     * </code
     *
     * @author Sven Schrodt
     * @param array $array
     * @param String $sortKey
     */
    public static function sortByKeyNumeric(array &$array, $sortKey, $sortOrder = false)
    {
        self::$sortKey = $sortKey;
        if ($sortOrder) {
            if (! self::isValidSortOrder($sortOrder)) {
                throw new \InvalidArgumentException("Invalid sort order $sortOrder");
            }
            self::$sortOrder = strtolower($sortOrder);
        }
        // using usort with callback function
        usort($array, array(
            __CLASS__,
            'sortByKeyNumericCallback'
        ));
    }

    /**
     * Sorting array by child key alphabetically
     *
     * Inline example
     * <code>
     * $data = array(array('id' => 23,
     * 'name' => 'Hagbard'),
     * array('id' => 88,
     * 'name' => 'Equals'),
     * array('id' => 42,
     * 'name' => 'Meaning of life'));
     *
     * // sorting by name ascending
     * Common_Helper_Array::sortByKey($data, 'name', 'asc');
     * </code
     *
     * @author Sven Schrodt
     * @param array $array
     * @param String $sortKey
     */
    public static function sortByKeyAlpha(array &$array, $sortKey, $sortOrder = false)
    {
        self::$sortKey = $sortKey;
        if ($sortOrder) {
            if (! self::isValidSortOrder($sortOrder)) {
                throw new \InvalidArgumentException("Invalid sort order $sortOrder");
            }
            self::$sortOrder = strtolower($sortOrder);
        }
        // using usort with callback function
        usort($array, array(
        __CLASS__,
        'sortByKeyAlphaCallback'
            ));
    }

    /**
     * Sorting array by child key with parts of value
     *
     * @param array $array
     * @param string $sortKey
     * @param string $sortOrder
     * @throws \InvalidArgumentException
     */
    public static function sortByKeyPartOfValue(array &$array, $sortKey, $sortOrder = false)
    {

        self::$sortKey = $sortKey;
        if ($sortOrder) {
            if (! self::isValidSortOrder($sortOrder)) {
                throw new \InvalidArgumentException("Invalid sort order $sortOrder");
            }
            self::$sortOrder = strtolower($sortOrder);
        }
        // using usort with callback function
        usort($array, array(
        __CLASS__,
        'sortByKeyPartOfValueCallback'
            ));
    }

    /**
     * Callback function for self::sortByKeyNumieric()
     *
     * Returning  int value -1, 0, or 1
     * on (lt,eq, or gt) or vice versa
     * depending on sort order
     *
     * @author Sven Schrodt
     * @param mixed $a
     * @param mixed $b
     * @return int
     */
    protected static function sortByKeyNumericCallback($a, $b)
    {
        //temp. setting elements with key and zero values, if missing in child array
        if (! array_key_exists(self::$sortKey, $a) || is_null($a[self::$sortKey])) {
            $a[self::$sortKey] = 0;
        }
        if (! array_key_exists(self::$sortKey, $b) || is_null($b[self::$sortKey])) {
            $b[self::$sortKey] = 0;
        }

        // sort order ascending
        if (self::$sortOrder == 'asc') {
            // return 0 if equals
            if ($a[self::$sortKey] == $b[self::$sortKey]) {
                return 0;
                // -1 if less, or 1 if greater
            } else {
                return ((float) $b[self::$sortKey]) <
                ((float) $a[self::$sortKey]) ? 1 : - 1;
            }

        } elseif (self::$sortOrder == 'desc') { // or sort order descending
            // return 0 if equals
            if ($a[self::$sortKey] == $b[self::$sortKey]) {
                return 0;
                // 1 if less, or -1 if greater
            } else {
                return ((float) $b[self::$sortKey]) >
                ((float) $a[self::$sortKey]) ? 1 : - 1;
            }
        }
    }
    /**
     * Sorting by key with part of values
     *
     * @param mixed $a
     * @param mixed $b
     * @return number
     */
    protected static function sortByKeyAlphaCallback($a, $b)
    {
        if (! array_key_exists(self::$sortKey, $a) || is_null($a[self::$sortKey])) {
            $a[self::$sortKey] = '';
        }
        if (! array_key_exists(self::$sortKey, $b) || is_null($b[self::$sortKey])) {
            $b[self::$sortKey] = '';
        }
        // Sorting ascending
        if (self::$sortOrder == 'asc') {
            return strcmp($a[self::$sortKey], $b[self::$sortKey]);
        } elseif (self::$sortOrder == 'desc') { // // Sorting descending
            return strcmp($b[self::$sortKey], $a[self::$sortKey]);
        }
    }
    /**
     * Sorting by key with part of values
     *
     * @param mixed $a
     * @param mixed $b
     * @return number
     */
    protected static function sortByKeyPartOfValueCallback($a, $b)
    {
        if (! array_key_exists(self::$sortKey, $a) || is_null($a[self::$sortKey])) {
            $a[self::$sortKey] = '';
        }
        if (! array_key_exists(self::$sortKey, $b) || is_null($b[self::$sortKey])) {
            $b[self::$sortKey] = '';
        }

        // splitting by separator
        $tempA = explode(self::$partSeparator, $a[self::$sortKey]);
        $tempB = explode(self::$partSeparator, $b[self::$sortKey]);

        // Defining what part to be sorted
        $partA = (isset($tempA[self::$partOfValue])) ? $tempA[self::$partOfValue] : '';
        $partB = (isset($tempB[self::$partOfValue])) ? $tempB[self::$partOfValue] : '';

        // ascending
        if (self::$sortOrder == 'asc') {
            return strcmp($partA, $partB);
        } elseif (self::$sortOrder == 'desc') {  // descending
            return strcmp($partB, $partA);
        }
    }

    /**
     * Setting parameters for sorting  parts
     *
     * @param string $separator
     * @param int $part
     */
    public static function setParamPartSort($separator, $part)
    {
        // TODO Validation
        if (! is_numeric($part)) {
            throw new \InvalidArgumentException('$part MUST be a number');
        }
        if (! is_string($part)) {
            throw new \InvalidArgumentException('$separator  MUST be a string');
        }
        self::$partOfValue = (int) $part;
        self::$partSeparator = $separator;
    }


    /**
     * Checking value for sort order
     *
     * @param string $value
     * @return boolean
     */
    protected static function isValidSortOrder($value)
    {
        if (! is_string($value)) {
            return false;
        }
        return (in_array(strtolower($value), array(
            'asc',
            'desc'
        )));
    }
}
