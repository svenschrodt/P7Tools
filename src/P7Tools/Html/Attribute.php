<?php declare(strict_types = 1);
/**
 *  \P7Tools\\Html\Attribute
 *  
 *  class representing HTML attribute 
 *
 *  !Do not use in production until it is stable!
 *      
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-11
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Html;

class Attribute
{

    /**
     * Attribute's name 
     * 
     * @var string | null
     */
    protected $_name = null;
    
    /**
     * Attribute's value
     *
     * @var string | null
     */
    protected $_value = null;
    
    public function __construct(string $name, string $value)
    {
        $this->_name = $name;
        $this->_value = $value;
    }
}
