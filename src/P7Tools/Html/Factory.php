<?php declare(strict_types=1);
namespace P7Tools\Html;

class Factory
{

    public function __call($type, $param)
    {
        return self::__callStatic($type, $param);
    }

    public static function __callStatic($type, $param)
    {
        return new Element($type, $param[0], $param[1]);
    }

    public static function getNodeList($type, array $attribs, array $content)
    {
        $collection = array();
        foreach ($content as $k => $v) {
            $tmp = new Element($type, $attribs, $v);
            $collection[] = $tmp;
        }
        return $collection;
    }
}