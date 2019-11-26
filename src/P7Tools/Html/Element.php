<?php declare(strict_types=1); declare(strict_types=1);
/**
 * Creating HTML elements from PHP data structures
 *
 * @package Mpm
 * @author Sven Schrodt
 * @since 2016-02-02
 */
namespace P7Tools\Html;

class Element
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
     * @var mixed
     */
    protected $_content = array();

    /**
     * Optional elment attributes
     *
     * @var mixed
     */
    protected $_attribs = array();

    /**
     * Flag, i empty element
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
    public function __construct($type, array $attribs = array(), $content = null)
    {
        $this->_type = strtolower($type);
        $this->addContent($content);
        $this->_attribs = $attribs;
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
     * Setting eine attribute
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

