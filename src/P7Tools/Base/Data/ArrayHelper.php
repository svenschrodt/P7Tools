<?php
declare(strict_types = 1);
/**
 * P7Tools\Base\Data\Container
 *
 * Generic class helping to work with arrays:
 * -
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

class ArrayHelper
{

    /**
     *
     * @var string
     */
    public static $elementSeparator = '|';

    /**
     *
     * @var string
     */
    public static $keyLimitBegin = '[';

    /**
     *
     * @var string
     */
    public static $keyLimitEnd = ']';

    /**
     * 
     * @var string
     */
    public static $assignmentSign = '=>';

    /**
     * OS dependant end of line (LF, CRLF, LFCR)
     * @var string
     */
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
    public static function getPropertyListFromCollection(array $data, string $propertyName) : array
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
    public static function getArrayAsString(array $data, bool $withKeys = false) : string
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
                $value = $tmp . '[OBJECT: ' . get_class($value) . ']';
            } elseif (is_array($value)) {
                $value = $tmp . '[ARRAY]';
            } else {
                $value = $tmp . $value;
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
    public static function getMultiArrayAsString(array $data, bool $withKeys = false) : string
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
    public static function getArrayFromCsv(string $fileName, bool $titleFirstLine = true) : array
    {
        $data = array();
        //@FIXME - validating file resource
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
