<?php

declare(strict_types = 1);
/**
 * \P7Tools\Base\Data\NetString
 *
 * Class representing net strings as invented by djb
 *
 * @FIXME !!!
 *
 * @see http://cr.yp.to/proto/netstrings.txt
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 04.12.2019
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Base\Data;

class NetString
{

    // @FIXME - public members ???

    /**
     * Length of net string
     *
     * @var integer
     */
    public $length = 0;

    /**
     * String to be encoded as net string
     *
     * @var string
     */
    public $payload = '';

    /**
     * Encoded net string (incl.
     * all nec. info for safe decoding)
     *
     * @var string
     */
    public $encoded = '';

    /**
     * Start of net string
     *
     * @var string
     */
    const NETSTRING_START = '<';

    /**
     * End of net string
     *
     * @var string
     */
    const NETSTRING_END = '>';

    /**
     * Encoding given string
     *
     * @param string $string
     */
    public function encodeString(string $string): string
    {
        $this->encoded = self::NETSTRING_START;
        $encString = $this->stringToHex($string);
        $this->length = strlen($string);
        $encLength = $this->stringToHex((string) $this->length);        
       return  $this->encoded .= $encLength . ' ' . dechex(ord(':')) . ' ' . $encString . ' ' . dechex(ord(',')) . self::NETSTRING_END;
    }

    /**
     * Convert string to a hexadecimal representation
     * 
     * @param string $string
     * @return string
     */
    protected function stringToHex(string $string) : string 
    {
        $temp = array();
        for ($i = 0; $i < strlen($string); $i ++) {
            $temp[$i] = dechex(ord($string[$i]));
        }

        $enc = implode(' ', $temp);
        return $enc;
    }
}
