<?php declare(strict_types=1);
/**
 * P7Tools\Base\File\Exception
 *
 * Exception class for file access purpose
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
    
    /**
     * File or directory not found error message as [s|f]printf string
     * 
     * @var string
     */
    const NO_SUCH_FILE_OR_DIRECTORY= '%s: No such file or directory';
    
    /**
     * Permission denied error message as [s|f]printf string
     *
     * @var string
     */
    const PERMISSION_DENIED = '%s: Permission denied';
    
    /**
     * Contructor function 
     * 
     * @param string $message
     */
    public function _construct(string $message = '')
    {
        parent::__construct($message);
    }

} 