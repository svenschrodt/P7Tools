<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Base\Data\Transformer
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
    public static function getDataFromIniFile($fileName)
    {
        if(!file_exists($fileName)) {
            throw new FileException('File does not exists');
        } else {
            return parse_ini_file($fileName, true);
        }
    }

    /***
     * @param Container $data
     * @return array
     * @codeCoverageIgnore
     */
    public static function getArrayFromContainerObject(\P7Tools\Base\Data\Container $data)
    {
        $dataAsArray = array();
        foreach($data as $key => $value) {
            $dataAsArray[$key] = $value;
        }
        return $dataAsArray;
    }

    /**
     * @param array $data
     * @return Container
     * @codeCoverageIgnore
     */
    public static function getContainerObjectFromArray(Array $data)
    {
        $container = new \P7Tools\Base\Data\Container();
        foreach($data as $key => $value) {
            $container->$key = $value;
        }
        return $container;
    }
} 