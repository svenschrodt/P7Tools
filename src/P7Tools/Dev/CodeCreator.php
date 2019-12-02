<?php declare(strict_types=1);
/**
 * P7Tools\Dev\CodeCreator
 *
 * Class to generate (formatted) source code from different data structures and
 * resources
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Dev;
use P7Tools\Base\Data\Symbol;

class CodeCreator
{

    /**
     * Returning quoted value
     * 
     * @param string $value - string to be quoted
     * @param string $qs - sign used for quoting 
     * @return string - result: quoted string
     */
   public static function quote(string $value, string $qs = Symbol::SINGLE_QUOTE) : string 
    {
        return sprintf("$qs%s$qs", $value);
    }

    /**
     * Generate enumeration list from values in $data
     * 
     * @param array $data
     * @param string $quote
     * @param string $separator
     * @return string
     */
    public static function getEnumeration(array $data, string $quote = Symbol::SINGLE_QUOTE, string $separator=', ') : string
    {

        foreach ($data as &$value) {
            $value = self::quote($value, $quote);
        }

        return implode($separator, $data);
    }


    /**
     * Generate assignment statement 
     * 
     * @param string $key
     * @param string $value
     * @param string $quote
     * @param string $eol
     * @param string $assignId
     * @return string
     */
    public static function getAssignment(string $key, string $value, string $quote = Symbol::SINGLE_QUOTE,string  $eol='', string $assignId=Symbol::DEFAULT_ASSIGNMENT_IDENTIFIER) : string
    {
        return implode(' ', array(
            $key,
            $assignId,
            self::quote($value)
        )) .$eol;
    }

    /**
     * Generate assignment statements from array $data
     *  
     * @param array $data
     * @param string $quote
     * @param bool $asString
     * @param string $separator
     * @param string $eol
     * @param string $assignId
     * @return string|string[]
     */
    public static function getAssignmentList(array $data, string $quote = Symbol::SINGLE_QUOTE, bool $asString = true, string $separator = PHP_EOL, $eol='', string $assignId=Symbol::DEFAULT_ASSIGNMENT_IDENTIFIER)
    {
        $tmp = array();
        foreach ($data as $key => $value) {
            $tmp[] = self::getAssignment($key, $value, $quote, $eol);
        }
        return ($asString) ? implode($separator, $tmp) : $tmp;
    }

    /**
     * Generate given expression in parenthesis
     * 
     * @param string $expression
     * @param string $start
     * @param string $end
     * @return string
     */
    public static function parenthesiseExpression(string $expression, string $start=Symbol::OPEN_PARENTHESIS, string $end=Symbol::CLOSE_PARENTHESIS) : string
    {
        return "{$start}{$expression}{$end}";
    }

}