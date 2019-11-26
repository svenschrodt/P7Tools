<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Mvc\ViewInterface
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
namespace P7Tools\Mvc;

interface ViewInterface
{

    public function assign($name, $value);

    public function render();

    public function setViewPath($path);

    public function setCurrentTemplate($path);


} 