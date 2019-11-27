<?php declare(strict_types=1);
/**
 * P7Tools\Http\CurlClient
 * 
 * Htttp client using Curl extension
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */

namespace P7Tools\Http;

class CurlClient
{
    /**
     * Content from received from url via http
     * @var string
     */
    protected $_content = '';
    
    /**
     * Http response code received by last request
     * 
     * @var integer
     */
    protected $_responseCode = 0;
    
    /**
     * Cosntructor
     * 
     * @throws \ErrorException
     */
    public function __construct()
    {
        if (!function_exists('curl_version')) {
            throw new \ErrorException('Extension cURL needed!');
        };
    }

    /**
     * Getting content via http from url
     * 
     * @param string $url
     * @return boolean|mixed
     */
   public function getUrlContent(string $url)
   {
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/666.0 (Commodore Basic 2.0) P7Tools library/0.0.23');
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       $this->_content = curl_exec($ch);
       $this->_responseCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
       curl_close($ch);
       return ($httpcode >= 200 && $httpcode < 300) ? $this->_content : false;
   }


}