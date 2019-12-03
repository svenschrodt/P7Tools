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
 * @todo Add methods, whenever another string* functionality is needed in project development 
 * 
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Base\Data;

use P7Tools\Xml\Validator;

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
     * Converting current content into camelCased string, separarted by substring boundary
     * 
     * @param bool $firstUpper
     * @param string $boundary
     * @return \P7Tools\Base\Data\StringClass
     */
    public function toCamelCase(bool $firstUpper = false, string $boundary = Symbol::SINGLE_UNDERSCORE)
    {
        $this->_content = StringNameTransformer::getcamelCasedString($this->_content, $firstUpper,$boundary); 
        return $this;
    }
    
    /**
     * Adding string content
     * 
     * @param string $content
     * @return \P7Tools\Base\Data\StringClass
     */
    public function add(string $content) : StringClass
    {
        $this->_content += $content;
        return $this;
   }
   
   
   /**
    * Settting string content -current content will be overwritten
    *
    * @param string $content
    * @return \P7Tools\Base\Data\StringClass
    */
   public function set(string $content) : StringClass
   {
       $this->_content = $content;
       return $this;
   }
   /**
    * Deleting string content
    *
    * @param string $content
    * @return \P7Tools\Base\Data\StringClass
    */
   public function delete() : StringClass
   {
       $this->_content = '';
       return $this;
   }
    
    /**
     * Getting index (first character's position) of substring in current instance
     * Returning false, if not found
     * 
     * @param string $string
     * @return int | false
     */
    public function lastIndexOf(string $string)
    {
        return strrpos($this->_content, $string);
    }

    /**
     * Splitting string into substrings separated by boundary string
     * 
     * @param string $separator
     * @return array
     */
    public function split(string $boundary )
    {
        /**
         * @todo adding optional parameter for deciding behaviour on $boundary not found
         * - returning [], [$boundary], false, null ??
         */ 
        return explode($boundary , $this->_content); 
    }
    
    public function validatesTo(ValidatorInterface $validator)
    {
        return  $validator->isValid((string) $this->_content);
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