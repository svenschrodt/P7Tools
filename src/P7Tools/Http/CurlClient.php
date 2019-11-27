<?php declare(strict_types=1);
/**
 * P7Tools\Http\CurlClient
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

namespace P7Tools\Http;

class CurlClient
{

    public function __construct()
    {
        if (!function_exists('curl_version')) {
            throw new \ErrorException('Extension cURL needed!');
        };
    }

//    public function getUrlContent($url)
//    {
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/666.0 (Commodore Basic 2.0) P7Tools library/0.0.23');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        $data = curl_exec($ch);
//        echo '<textarea>';
//        echo $data;
//        echo '</textarea>';
//        die();
//        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//        return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
//    }


}