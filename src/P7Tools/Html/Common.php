<?php declare(strict_types=1); declare(strict_types=1);
/**
 * Common methods for creating HTML elements from PHP data structures
 * 
 * 
 *
 *
 * @package  P7Tools
 * @author Sven Schrodt
 * @since 2016-02-02
 */
namespace P7Tools\Html;
class  Common
{

    /**
     * Quoting a value
     *
     * @param string $value
     * @param string $qs
     * @return string
     */
    public static function quote($value, $qs = '"')
    {
        return sprintf("$qs%s$qs", $value);
    }

    /**
     * Creating assignment like $Key = '$value'
     *
     * @param string $key
     * @param mixed $value
     * @param string $quote
     * @param string $eol
     * @param string $assignId
     * @return string
     */
    public static function getAttributeAssignment($key, $value, $quote = '"', $eol = '', $assignId = '=')
    {
        return implode('', array($key,$assignId,self::quote($value)
        )) . $eol;
    }

    /**
     * Creating list of assignments
     *
     * @param array $data
     * @param string $quote
     * @return string
     */
    public static function getAttributeList(array $data, $quote = '"')
    {
        $tmp = array();
        foreach ($data as $key => $value) {
            $tmp[] = self::getAttributeAssignment($key, $value, $quote);
        }
        return implode(' ', $tmp);
    }
}