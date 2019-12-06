<?php declare(strict_types=1);
/**
 * \P7Tools\Html\Node
 * 
 * Abstract foundation class representing node from DOM
 * 
 * @TODO --> rewrite as Element extends \P7Tools\Html\Node
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

abstract class Node
{
    /**
     * Flag, if current instance is text node
     * 
     * @var bool
     */
    protected $_isTextNode = false;
    
    /**
     * Flag, if current instance is HTML element
     *
     * @var bool
     */
    protected $_isHtmlNode = true;
    
    /**
     * Flag, if current instance is empty HTML element
     *
     * @var bool
     */
    protected $_isEmptyElement = false;
    
    /**
     * Setting current instance to text or element node
     *
     * @var bool
     */
    protected function setType(bool $isTexNode=false) 
    {
        $this->_isTextNode = $isTexNode;
        $this->_isHtmlNode = ($this->_isTextNode) ? false : true;
    }
}

