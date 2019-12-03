<?php
declare(strict_types = 1);
/**
 * P7Tools\Base\Data\String
 *
 * Class representing string as object with methods to manipulate content
 * - naming convention
 * - encoding (for URIs etc)
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
namespace P7Tools\Base\Data;

class StringClass
{

    /**
     * String content of current instance
     *
     * @var string
     */
    protected $_content = '';

    /**
     * Generic constructor function
     *
     * @param string $content
     */
    public function __construct(string $content = '')
    {
        $this->_content = $content;
    }

    
    /**
     * Converting current content into lower case
     *
     * @return \P7Tools\Base\Data\StringClass
     */
    public function toLowerCase(): StringClass
    {
        $this->_content = strtolower($this->_content);
        return $this;
    }

    /**
     * Converting current content into upper case
     *
     * @return \P7Tools\Base\Data\StringClass
     */
    public function toUpperCase(): StringClass
    {
        $this->_content = strtoupper($this->_content);
        return $this;
    }

    /**
     * Converting current content's first character into into lower case
     *
     * @return \P7Tools\Base\Data\StringClass
     */
    public function toLowerFirst(): StringClass
    {
        $this->_content = lcfirst($this->_content);
        return $this;
    }

    /**
     * Converting current content's first character into upper case
     *
     * @return \P7Tools\Base\Data\StringClass
     */
    public function toUpperFirst(): StringClass
    {
        $this->_content = ucfirst($this->_content);
        return $this;
    }

    /**
     * Magical interceptor invoked, if instance is used in string context
     * - returning string representation of current content
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->_content;
    }
} 