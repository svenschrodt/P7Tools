<?php declare(strict_types=1);

/**
 * Creating HTML form elements from PHP data structures
 *
 * @package P7Tools
 * @author Sven Schrodt
 * @since 2016-02-02
 */
namespace P7Tools\Html;
class Form
{

    /**
     * creating select element
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
     *
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
