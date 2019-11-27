<?php declare(strict_types=1);

/**
 * \P7Tools\Html\Form
 * 
 * Creating HTML form elements from PHP data structures
 * 
 * 
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net> * @since 2016-02-02
 */
namespace P7Tools\Html;

class Form
{

    /**
     * Creating select element
     *
     * @param string $id
     * @param array $attribs
     * @param array $data
     * @param string $selected
     * @return P7Tools\Html\Element;
     */
    public static function select($id, array $attribs = array(), array $data, $selected = false)
    {
        if (! isset($attribs['name'])) {
            $attribs['name'] = $id;
        }
        $attribs['id'] = $id;
        $select = new Element('select', $attribs);
        $collection = array();
        foreach ($data as $k => $v) {
            $tmp = new Element('option', array('value' => $k
            ), $v);
            if ($k == $selected) {
                $tmp->setAttribute('selected', 'selected');
            }
            $collection[] = $tmp;
        }
        $select->addContent($collection);
        return $select->__toString();
    }

    /**
     * Creating radio element
     * @param string $name
     * @param array $attribs
     * @param array $data
     * @return array
     */
    public static function radio($name, array $attribs, array $data)
    {
        $attribs = array_merge(array('type' => 'radio', 'name'=>$name), $attribs);
        //
        $list = Factory::getNodeList('input', $attribs, $data);
        return $list;
    }
}
