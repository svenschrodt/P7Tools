<?php declare(strict_types=1);

/**
 * Static methods helping with arrays
 *
 * @author Sven Schrodt
 * @since 2012-03-13
 */
namespace P7Tools\Base\Data;

class ArrayHelper
{

    public static $elementSeparator = '|';

    public static $keyLimitBegin = '[';

    public static $keyLimitEnd = ']';

    public static $assignmentSign = '=>';

    public static $lineSeparator = PHP_EOL;

    /**
     * Extracting values of given Keys from two dimensional arrays
     *
     * Inline example
     *
     * <code>
     * $data = array( 1 => array('name' => 'Foo',
     * 'job' => 'waiter'),
     * 3 => array('name' => 'Bar',
     * 'job' => 'genius')
     * );
     * // We want only the names:
     * $names =
     * Common_Helper_Array::getPropertyListFromCollection($data,'name');
     * </code>
     *
     * @author Sven Schrodt
     * @param array $data
     * @param string $propertyName
     * @return array
     */
    public static function getPropertyListFromCollection(array $data, $propertyName)
    {
        $propertyList = array();
        foreach ($data as $item) {
            if (array_key_exists($propertyName, $item)) {
                $propertyList[] = $item[$propertyName];
            }
        }
        return $propertyList;
    }

    /**
     * Returns array's contents as string
     *
     * @param array $data
     * @param string $withKeys
     * @return string
     */
    public static function getArrayAsString(array $data, $withKeys = false)
    {
        if (count($data) == 0) {
            return '';
        }
        foreach ($data as $key => &$value) {
            $tmp = '';

            if ($withKeys) {
                $tmp = self::$keyLimitBegin . $key . self::$keyLimitEnd . self::$assignmentSign;
            }

            if (is_object($value) && ! method_exists($value, '__toString')) {
                $value = $tmp .'[OBJECT: ' . get_class($value) . ']';
            } elseif (is_array($value)) {
                $value = $tmp.'[ARRAY]';
            } else {
                $value = $tmp.$value;
            }
        }

        return implode(self::$elementSeparator, $data);
    }

    /**
     * Returns multi dimensional array's contents as string
     *
     * @param array $data
     * @param string $withKeys
     * @return string
     */
    public static function getMultiArrayAsString(array $data, $withKeys = false)
    {
        foreach ($data as $item) {

            $tmp[] = self::getArrayAsString($item, $withKeys);
        }

        return implode(self::$lineSeparator, $tmp);
    }

    /**
     * Getting array with data from csv file
     *
     * @param string $fileName
     * @param bool $titleFirstLine
     * @return array
     */
    public static function getArrayFromCsv($fileName, $titleFirstLine = true)
    {
        $data = array();
        $fh = fopen($fileName, 'r');
        if ($titleFirstLine) {
            $head = fgets($fh);
            $keys = explode(';', $head);
        } else {}

        while (! feof($fh)) {
            $tmp = array();
            $line = fgets($fh, 2048);
            $values = explode(';', $line);
            foreach ($values as $idx => $val) {
                if (is_array($keys)) {
                    $tmp[$keys[$idx]] = $val;
                } else {
                    $tmp[] = $val;
                }
            }
            $data[] = $tmp;
        }
        return $data;
    }
}
