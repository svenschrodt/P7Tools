<?php declare(strict_types=1);
/**
 * NetString
 *
 * @see http://cr.yp.to/proto/netstrings.txt
 *
 * @version 0.0.24
 */
namespace P7Tools\Base\Data;
class NetString
{
    public $length;
    public $payload;
    public $encoded;

    const NETSTRING_START = '<';
    const NETSTRING_END = '>';

    public function encodeString($string)
    {


        $this->encoded = self::NETSTRING_START;

       $encString = $this->stringToHex($string);
       $this->length = strlen($string);
       $encLength = $this->stringToHex((string) $this->length);

//        die($encString . ' ' . $encLength);

       $this->encoded.= $encLength . ' ' . dechex(ord(':')) . ' ' .   $encString . ' ' . dechex(ord(',')) .self::NETSTRING_END;
    }

    protected function stringToHex($string)
    {
        $temp = array();
        for($i=0;$i<strlen($string);$i++) {
            $temp[$i] = dechex(ord($string[$i]));
        }

        $enc = implode(' ', $temp);
        return $enc;
    }


}
