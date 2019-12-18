<?php declare(strict_types = 1);
/**
 * P7Tools\Base\Type\Bool
 *
 * Class representing boolean object with methods to manipulate content and calculate
 * 
 *  !Do not use in production until it is stable!
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
namespace P7Tools\Base\Type;

use P7Tools\Tools\ValidatorInterface;

class BoolClass extends AbstractType
{

    /**
     * Boolean value of current instance or null
     *
     * @var null | bool
     */
    protected $_value = null;

    /**
     * Generic constructor function
     *
     * @param int $value
     */
    public function __construct(bool $value )
    {
        $this->_value = $value;
    }

    /**
     * Getting current int value of instance 
     * 
     * @return int
     */
    public function get() : bool
    {
        return $this->_value;
    }
    
    
    protected function _operateWith(string $operator, bool $operand)
    {
        //@todo implement $operator [|&~!]
    }
    
    /**
     * Set current int value for instance
     * 
     * @param int $value
     * @return \P7Tools\Base\Type\BoolClass
     */
    public function set(bool $value) : BoolClass
    {
        $this->_value = $value;
        return $this;
    }
    
  
    /**
     * Generic validator function - uses external validator classes 
     * implementing \P7Tools\Tools\ValidatorInterface
     *
     * @param ValidatorInterface $validator
     * @return bool
     */
    public function validatesTo(ValidatorInterface $validator) : bool
    {
        //  we want to validate the _boolean_ representation_ of currrent instance
        return  $validator->isValid($this->get());
    }
} 