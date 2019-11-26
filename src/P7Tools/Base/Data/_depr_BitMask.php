<?php declare(strict_types=1); declare(strict_types=1);
//DEFINE('INTEGER_LENGTH',31); // Stupid signed bit.
namespace P7Tools\Base\Data;

class BitMask
{

    const INTEGER_LENGTH = 31;
    protected $_mask = array();

    public function set( $bit ) // Set some bit
    {
        $key = (int) ($bit / self::INTEGER_LENGTH);
        $bit = (int) fmod($bit, self::INTEGER_LENGTH);
        $this->_mask[$key] |= 1 << $bit;
        var_dump(array('key'=>$key, 'bit'=>$bit));die;
    }

    public function remove( $bit ) // Remove some bit
    {
        $key = (int) ($bit / self::INTEGER_LENGTH);
        $bit = (int) fmod($bit,self::INTEGER_LENGTH);
        $this->_mask[$key] &= ~ (1 << $bit);
        if(!$this->_mask[$key])
            unset($this->_mask[$key]);
    }

    public function toggle( $bit ) // Toggle some bit
    {
        $key = (int) ($bit / self::INTEGER_LENGTH);
        $bit = (int) fmod($bit,self::INTEGER_LENGTH);
        $this->_mask[$key] ^= 1 << $bit;
        if(!$this->_mask[$key])
            unset($this->_mask[$key]);
    }

    public function read( $bit ) // Read some bit
    {
        $key = (int) ($bit / self::INTEGER_LENGTH);
        $bit = (int) fmod($bit,self::INTEGER_LENGTH);
        return $this->_mask[$key] & (1 << $bit);
    }

    public function stringin($string) // Read a string of bits that can be up to the maximum amount of bits long.
    {
        $this->_mask = array();
        $array = str_split( strrev($string), self::INTEGER_LENGTH );
        foreach( $array as $key => $value )
        {
            if($value = bindec(strrev($value)))
                $this->_mask[$key] = $value;
        }
    }

    public function __toString() // Print out a string of your nice little bits
    {
        $string = "";

        $keys = array_keys($this->_mask);
        sort($keys, SORT_NUMERIC);

        for($i = array_pop($keys);$i >= 0;$i--)
        {
            if($this->_mask[$i])
                $string .= sprintf("%0" . self::INTEGER_LENGTH . "b",$this->_mask[$i]);
        }
        return $string;
    }

    public function clear() // Purge!
    {
        $this->_mask = array();
    }

    public function debug() // See what's going on in your bitmask array
    {
        var_dump($this->_mask);
    }
}
?>