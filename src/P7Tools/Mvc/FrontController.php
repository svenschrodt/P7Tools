<?php declare(strict_types=1);
/**
 * P7Tools\Mvc\FrontController
 *
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

abstract class FrontController
{
    protected $response, $request, $application;

    public function __construct(\P7Tools\Mvc\Application $application)
    {
        $this->application = $application;
    }
}