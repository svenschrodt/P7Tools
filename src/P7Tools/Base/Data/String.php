<?php declare(strict_types=1);
/**
 * P7Tools\Base\Data\String
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
namespace P7Tools\Base\Data;

class String
{
    /**
     * Returning file path for current OS
     *
     * @param array $data
     * @return string
     */
    public static function getFilePathFromParts(array $data)
    {
        return implode(DIRECTORY_SEPARATOR, $data);
    }

} 