<?php
/**
 * P7Tools\Base\Data\String
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Dev;
use P7Tools\Base\Data\Symbol;
class CodeCreator
{

    /**
     * Returning quoted value
     *
     * @param array $data
     * @return string
     */
    public static function quote($value, $qs = Symbol::SINGLE_QUOTE)
    {
        return sprintf("$qs%s$qs", $value);
    }

    public static function getEnumeration(array $data, $quote = Symbol::SINGLE_QUOTE, $separator=', ')
    {

        foreach ($data as &$value) {
            $value = self::quote($value, $quote);
        }

        return implode($separator, $data);
    }


    public static function getAssignment($key, $value, $quote = Symbol::SINGLE_QUOTE, $eol='', $assignId=Symbol::DEFAULT_ASSIGNMENT_IDENTIFIER)
    {
        return implode(' ', array(
            $key,
            $assignId,
            self::quote($value)
        )) .$eol;
    }

    public static function getAssignmentList(array $data, $quote = Symbol::SINGLE_QUOTE, $asString = true, $separator = PHP_EOL, $eol='', $assignId=Symbol::DEFAULT_ASSIGNMENT_IDENTIFIER)
    {
        $tmp = array();
        foreach ($data as $key => $value) {
            $tmp[] = self::getAssignment($key, $value, $quote, $eol);
        }
        return ($asString) ? implode($separator, $tmp) : $tmp;
    }

    public static function parenthesiseExpression($expression, $start=Symbol::OPEN_PARENTHESIS, $end=Symbol::CLOSE_PARENTHESIS)
    {
        return "{$start}{$expression}{$end}";
    }

}