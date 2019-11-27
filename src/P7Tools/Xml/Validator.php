<?php declare(strict_types=1);
/**
 * P7Tools\Xml\Validator
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Xml;


class Validator
{
    /**
     * Deciding if given content is valid content for text node
     *
     * @param $content
     * @return bool
     */
    public static function isValidTextNodeContent($content)
    {
        return is_string($content);
    }

    /**
     * Deciding if given content is valid content for text node
     *
     * @param $content
     * @return bool
     */
    public static function NOisValidElement($content)
    {
        //TODO also allowing instances of \SimpleXMLElement, \DOMElement etc.
        return $content instanceof \P7Tools\Xml\Element;
    }

    /**
     * Checking if given content is valid element content (text or element)
     *
     * @param $content
     * @return bool
     */
    public static function isValidElementContent($content)
    {
        return self::isValidElement($content) || self::isValidTextNodeContent($content);
    }

} 