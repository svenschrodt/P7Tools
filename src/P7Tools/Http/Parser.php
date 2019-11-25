<?php declare(strict_types=1);
/**
 * P7Tools\Http\Parser
 *
 * Class to parse HTTP requests amd responses
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.24
 */
namespace P7Tools\Http;

class Parser
{
    /**
     * Splitting message to header and body part (separated by CRLFCRLF)
     *
     * @param $message
     * @return array
     */
    public static function splitMessage($message)
    {
        return explode(Protocol::MESSAGE_SEPARATOR, $message);
    }

    /**
     * Checking if given string is a valid HTTP message, containing CRLFCRLF as separator
     * 
     * @param $string
     * @return bool
     */
    public static function isValidMessage($string)
    {
        return (strstr($string, Protocol::MESSAGE_SEPARATOR)) ? true : false;
    }

    /**
     * Splitting HTTP header lines in HTTP message to usable php array
     *
     * @param $headers
     * @return \P7Tools\Base\Data\Container
     */
    public static function splitHeaders($headers)
    {
        $parts = explode(Protocol::HEADER_SEPARATOR, $headers);
        $headerData = new \P7Tools\Base\Data\Container();
        $headerData->firstLine = trim(array_shift($parts));
        foreach($parts as $headerLine) {
            if(strstr($headerLine, ':')) {
                list($key, $value) = explode(':', $headerLine);
                $propertyName = trim($key);
                $headerData->$propertyName = trim($value);
            }
        }
        return $headerData;
    }

}