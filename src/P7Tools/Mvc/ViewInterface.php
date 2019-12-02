<?php declare(strict_types=1);
/**
 * P7Tools\Mvc\ViewInterface
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

interface ViewInterface
{

    /**
     * Assigning named attribute to current view 
     * @param string $name
     * @param mixed $value
     */
    public function assign(string $name, $value);

    /**
     * Rendering current view
     */
    public function render();

    /**
     * Setting current path to view templates
     * 
     * @param string $path
     * @return \P7Tools\Mvc\ViewInterface
     */
    public function setViewPath(string $path);

    /**
     * Setting current path to view templates
     *
     * @param string $path
     * @return \P7Tools\Mvc\ViewInterface
     */
    public function setCurrentTemplate(string $path);


} 