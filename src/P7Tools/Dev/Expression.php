<?php
/**
 *class suppoirt gernation of logical expressions like:
 *
 * ((a>b) OR (b==c)) AND (d IN ())
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Dev;
use P7Tools\Base\Data\Symbol;
class Expression
{
    protected $_operandLeft;
    protected $_operandRight;
    protected $_operator;

    protected $operators=array('AND', 'OR', 'NOT', 'LT', 'GT', 'EQ');

    public function __construct()
    {

    }

    public function let($operand)
    {
        $this->_operandLeft = $operand;
        return $this;
    }

    public function __call($method, $args)
    {
        $operator = strtoupper($method);
        if(!in_array($operator, $this->operators)) {
            throw new \ErrorException('Unknoen operator ' . $method);
        } else {
            $this->_operandRight=$args[0];
            $this->_operator = $operator;
        }
    }

    public function __toString()
    {
        //@TODO $this->_validateExpression()
        return implode(' ', array($this->_operandLeft, $this->_operator, $this->_operandRight));
    }



}