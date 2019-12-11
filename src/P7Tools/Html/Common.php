<?php

declare(strict_types = 1);
/**
 * \P7Tools\HTml\Common
 *
 * Common methods for creating HTML nodes from PHP data structures
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Html;

class Common
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
        /**
         * Handling HTML class(es)- generating attribute assignment value part
         * e.g:
         * 
         * <code>
         *  "name" ||  "classOne classTwo"
         * </code> 
         */
        
        if($key === 'class' && is_array($value)) {
            $value = implode(' ', $value);
        }
        
        /** 
         * Handling null values - e.g: pre-defined $this->_attributes['id']
         */
        if(is_null($value)) {
            return '';
        }
        
        /**
         * Generating assignment - e.g:
         * <code>
         *  href="Foo.php"
         * </code>
         */
        return implode('', array(
            $key,
            $assignId,
            self::quote($value)
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