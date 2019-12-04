<?php
declare(strict_types = 1);
/**
 * P7Tools\Base\Type\Int
 *
 * Class representing float as object with methods to manipulate content and calculate
 * - ranges
 * - loops with steps
 * - tbd.
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
namespace P7Tools\Base\Type;

use P7Tools\Tools\ValidatorInterface;

class FloatClass extends AbstractType
{

    /**
     * float number value of current instance
     *
     * @var int
     */
    protected $_value;

    /**
     * Generic constructor function
     *
     * @param float $value
     */
    public function __construct(float $value = 0)
    {
        $this->_value = $value;
    }

    /**
     * Getting current float value of instance 
     * 
     * @return int
     */
    public function get() : int
    {
        return $this->_value;
    }
    
    /**
     * Set current float value for instance
     * 
     * @param float $value
     * @return \P7Tools\Base\Type\IntClass
     */
    public function set(float $value) : IntClass
    {
        $this->_value = $value;
        return $this;
    }
    
    /**
     * Returning generator for numbers from current float value up to $to, stepped by $step
     *
     * @param float $to
     * @param float $step
     * @return \Generator
     */
    public function upTo(float $to, float $step = 0.1): \Generator
    {
        //@todo deciding how to handle IntClass::$_number < $to
        for ($i = $this->_value; $i <= $to; $i += $step) {
            yield $i;
        }
    }
    
    /**
     * Returning generator for numbers from current float value down to $to, stepped by $step
     *
     * @param float $to
     * @param float $step
     * @return \Generator
     */
    public function downTo(float $to, float $step = 0.1): \Generator
    {
        //@todo deciding how to handle IntClass::$_number < $to
        for ($i = $this->_value; $i <= $to; $i -= $step) {
            yield $i;
        }
    }
    
    /**
     * Generic validator function uses external validator classes implementing
     * \P7Tools\Tools\ValidatorInterface
     *
     * @param ValidatorInterface $validator
     * @return bool
     */
    public function validatesTo(ValidatorInterface $validator) : bool
    {
        //  we want to validate the _string representation_ of currrent instance
        return  $validator->isValid($this->get());
    }
} 