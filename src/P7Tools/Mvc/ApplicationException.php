<?php

declare(strict_types = 1);
/**
 * \P7Tools\
 *
 *
 *
 * @todo !Do not use in production until it is stable!
 *      
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 02.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Mvc;

class ApplicationException extends \ErrorException
{

    const MISSING_APPLICATION_PATH = "Missing directory structure for application '%s'";
}
