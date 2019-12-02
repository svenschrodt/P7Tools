<?php declare(strict_types=1);
/**
 * P7Tools\Mvc\TemplateView
 * 
 * Class to handle templates of (MVC) layer view
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Mvc;

class TemplateView implements ViewInterface
{
    /**
     * 
     * @var array
     */
    protected $_content = [];
    
    /**
     * Generic constructor function 
     *  
     */
    public function __construct()
    {

    }

    /**
     * Assigning named attribute to current view
     * 
     * @see \P7Tools\Mvc\ViewInterface::assign()
     * @ return TemplateView
     */
    public function assign($name, $value) : TemplateView
    {
        $this->_content[$name] = $value;
        return $this;
    }

    /**
     * Rendering view 
     * 
     * {@inheritDoc}
     * @see \P7Tools\Mvc\ViewInterface::render()
     */
    public function render() : string
    {
        
    }

    /**
     * 
     * {@inheritDoc}
     * @see \P7Tools\Mvc\ViewInterface::setViewPath()
     * @return TemplateView
     */
    public function setViewPath($path) : TemplateView
    {
        return $this;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \P7Tools\Mvc\ViewInterface::setCurrentTemplate()
     * @return TemplateView
     */
    public function setCurrentTemplate($path) : TemplateView
    {
        return $this;
    }

}