<?php
declare(strict_types = 1);
/**
 * \P7Tools\Html\Node
 *
 * Class representing *text* node from DOM
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-06
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Html;

class Text extends Node
{

    /**
     * String representation of current instance 
     * 
     * @var string | null
     */
    protected $_value = null;

    /**
     * Constructor function
     */
    public function __construct(string $text = null)
    {
        $this->_value = $text;
        $this->_setType(true);
    }

    /**
     * Setting (overwriting opt. existing) value
     * 
     * @param string $text
     * @return \P7Tools\Html\Text
     */
    public function setValue(string $text)
    {
        $this->_value = $text;
        return $this;
    }
    
    /**
     * Adding (concat with opt. existing) value
     *
     * @param string $text
     * @return \P7Tools\Html\Text
     */
    public function addValue(string $text)
    {
        $this->_value = (is_null($this->_value)) ?  $text : $this->_value . $text;
        return $this;
    }
    
    /**
     * Magical interceptor uesd in string context
     */
    public function __toString(): string
    {
        return $this->_value;
    }
}

