<?php declare(strict_types=1); declare(strict_types=1);
/**
 * NetStringParser
 * @see http://cr.yp.to/proto/netstrings.txt
 * @since 10.08.2016
 * @author P290691 Sven Schrodt<Sven.Schrodt@mode-it-systems.de>
 * @version 0.0.24
 */
namespace P7Tools\Base\Data;
class NetStringParser
{
    protected $string ='<31 32 3a 68 65 6c 6c 6f 20 77 6f 72 6c 64 21 2c 31 32 3a 68 65 6c 6c 6f 20 77 6f 72 6c 64 21 2c>';


    public function decode($string=null)
    {
        $decoded = '';
        if(!is_null($string)) {
            $this->string=$string;
            //@TODO validation!
        }
        $chars = explode(' ', substr($this->string, 1, strlen($this->string)-2));

        $netStringList = new NetStringList();
        for($i=0;$i<count($chars);$i++) {
            $decoded .= chr(hexdec($chars[$i]));

        }
        $parts = explode(',', $decoded);
        if(!count($parts)) {
            return $netStringList;
        }
        unset($parts[count($parts)-1]);
        for($n=0;$n<count($parts);$n++) {
            list($netStringList->length[$n], $netStringList->payload[$n]) = explode(':', $parts[$n]);
        }
        return $netStringList;
    }

    //otected function
}