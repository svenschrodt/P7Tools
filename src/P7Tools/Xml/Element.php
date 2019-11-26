<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Xml\Element
 *
 * Class representing XML element
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

class Element
{

    /**
     * Element name
     *
     * @var
     */
    protected $name;

    /**
     * Content of element
     *
     * @var
     */
    protected $content = array();

    /**
     * Arrays storing optional element attributes
     *
     * Key equals attribute name, and value equals attribute value
     *
     * @var
     */
    protected $attributes;

    /**
     * Flag deciding if element is empty
     *
     * @var bool
     */
    protected $isEmpty = true;

    /**
     * Flag deciding if element is text node
     *
     * @var bool
     */
    protected $isTextNode = false;

    /**
     * \DOMElement property to use PHP#s DOM functionality
     *
     * @var
     */
    protected $domElement;

    public function __construct($name = 'node', $content = false, $attributes = array(), $namespace=false )
    {
        $this->name = $name;
        //TODO handling non text content DOMElement, arrays, DOMNodeList etc.
        $this->content = (!is_bool($content)) ? $content : false;
        if($this->content) {
            $this->isEmpty = false;
        }
        $this->attributes = $attributes;

        $dom = new \DOMDocument();
        $this->domElement = $dom->createElement($this->name, $this->content);
        $dom->appendChild($this->domElement);
        if(count($this->attributes) > 0) {
            foreach($this->attributes as $name => $value) {
                if(is_numeric($name)) {
                    $name = 'attribute_' . $name;
                }
                $this->domElement->setAttribute($name, $value);
            }
        }
    }

    public function __toString()
    {
       return $this->asString();
    }

    public function asString()
    {

        return $this->domElement->C14N();
    }

    public function exportAsDOMElement()
    {
        return $this->domElement;
    }

} 