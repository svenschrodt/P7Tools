<?php declare(strict_types=1);
/**
 * P7Tools\Base\File\Exception
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
namespace P7Tools\Base\File;

class Exception extends \ErrorException
{
    
    const NO_SUCH_FILE_OR_DIRECTORY= '%s: No such file or directory';
    
    /**
     * 
     * @param string $message
     */
    public function _construct(string $message = '')
    {
        parent::__construct($message);
    }

} 