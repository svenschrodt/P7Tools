<?php declare(strict_types=1);
/**
 * \P7Tools\Html\Element 
 * 
 * Class helping creation of HTML elements from PHP data structures
 * 
 * @TODO --> rewrite as Element extends \P7Tools\Html\Node
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

class Element extends Node
{

    /**
     * Type of element
     *
     * @var string
     */
    protected $_type;

    /**
     * Optional content of element
     *
     * @var array
     */
    protected $_content = array();

    /**
     * Optional element attributes
     *
     * @var array
     */
    protected $_attribs = array();

    /**
     * Flag, if element is empty 
     *
     * @var bool
     */
    protected $_isEmpty = true;

    /**
     * Constructor function
     *
     * @param string $type
     * @param array $attribs
     * @param string $content
     */
    public function __construct( string $type, array $attribs = array(), Element $content = null)
    {
        $this->_type = strtolower($type);
        $this->addContent($content);
        $this->_attribs = $attribs;
        //Setting type to element ! text node
        $this->_setType();
    }

    /**
     * Adding content(s) to element
     *
     * @param mixed $content
     * @return P7Tools\Html\Element;
     */
    public function addContent($content)
    {
        if(is_array($content)) {
            $this->_content = array_merge($this->_content, $content);
        } else {
            $this->_content[] = $content;
        }
        if(count($this->_content)) {
            $this->_isEmpty = false;
        }
        return $this;
    }

    /**
     * Setting attribute
     *
     * @param string $key
     * @param string $value
     * @return P7Tools\Html\Element;
     */
    public function setAttribute($key, $value)
    {
        $this->_attribs[$key] = $value;
        return $this;
    }

    /**
     * Setting attributes
     *
     * @param array $attribs
     * @return P7Tools\Html;
     */
    public function setAttributes(array $attribs)
    {
        foreach($attribs as $key => $value) {
            $this->setAttribute($key, $value);
        }
        return $this;
    }

    /**
     * Interceptor for usage in string context
     *
     * @return string
     */
    public function __toString()
    {
        $text = "<{$this->_type}";
        if(count($this->_attribs)) {
            $text .= ' ' . Common::getAttributeList($this->_attribs);
        }
        if($this->_isEmpty) {
            return $text . ' />';
        } else {
            $text .= '>' . implode('', $this->_content);
            return $text . "</{$this->_type}>" . PHP_EOL;
        }
    }
}

