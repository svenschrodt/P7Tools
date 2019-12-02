<?php declare(strict_types=1);
/**
 * P7Tools\Mvc\FrontController 
 * 
 * Abstract class to be used for applciation front 
 * controller instances
 *
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-02
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
*/
namespace P7Tools\Mvc;

abstract class FrontController
{
    /**
     * Class members to be over written in application FCs
     * 
     * @var P7Tools\Http\Response $response
     * @var P7Tools\Http\Request $request
     * @var P7Tools\Mvc\Application $application
     */
    protected $response, $request, $application;

    public function __construct(\P7Tools\Mvc\Application $application)
    {
        $this->application = $application;
        //@todo getting other members from $application
    }
}