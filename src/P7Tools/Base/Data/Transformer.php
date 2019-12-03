<?php declare(strict_types=1);
/**
 * P7Tools\Base\Data\Transformer
 * 
 * Transforming between file contents and  data structures 
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
use P7Tools\Base\File\Exception as FileException;

class Transformer
{
    /**
     * Getting Data from ini file
     *
     * @param $fileName
     * @return array
     * @throws FileException
     */
    public static function getDataFromIniFile(string $fileName) : array
    {
        if(!file_exists($fileName)) {
            throw new FileException('File does not exists');
        } else {
            return parse_ini_file($fileName, true);
        }
    }

    /***
     * Transforming Container object to @author sven

     * @param Container $data
     * @return array
     */
    public static function getArrayFromContainerObject(\P7Tools\Base\Data\Container $data) : array 
    {
        $dataAsArray = array();
        foreach($data as $key => $value) {
            $dataAsArray[$key] = $value;
        }
        return $dataAsArray;
    }

    /**
     * Transforming array structure to Contianer object
     * 
     * @param array $data
     * @return \P7Tools\Base\Data\Container
     * @codeCoverageIgnore
     */
    public static function getContainerObjectFromArray(Array $data) : \P7Tools\Base\Data\Container
    {
        $container = new \P7Tools\Base\Data\Container();
        foreach($data as $key => $value) {
            $container->$key = $value;
        }
        return $container;
    }
} 