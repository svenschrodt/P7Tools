<?php

declare(strict_types = 1);
/**
 * \P7Tools\Html\Factory
 *
 * Factory
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

class Factory
{

    /**
     * Magical interceptor function
     *
     * @param string $type
     * @param string $param
     * @return Element
     */
    public function __call(string $type, string $param)
    {
        return self::__callStatic($type, $param);
    }

    /**
     *
     * @param string $type
     * @param string $param
     * @return \P7Tools\Html\Element
     */
    public static function __callStatic(string $type, string $param)
    {
        return new Element($type, $param[0], $param[1]);
    }

    /**
     * Getting list of HTML elements 
     * 
     * @param string $type
     * @param array $attribs
     * @param array $content
     * @return \P7Tools\Html\Element[]
     */
    public static function getNodeList(string $type, array $attribs, array $content)
    {
        $collection = array();
        foreach ($content as $k => $v) {
            $tmp = new Element($type, $attribs, $v);
            $collection[] = $tmp;
        }
        return $collection;
    }
}