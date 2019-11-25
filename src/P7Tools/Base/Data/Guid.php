<?php declare(strict_types=1);
/**
 *
 *
 * @since 12.08.2016
 * @author   Sven Schrodt
 * @version 0.0.24
 */
namespace P7Tools\Base\Data;

class Guid
{

    /**
     * creates a 32 byte hexadecimal global unique ID
     *
     * @return string the unique ID
     */
    public static function getRandomGUID($strSecret = null)
    {
        $strSalt = self::getSalt();

        if($strSecret != null) {
            return md5(md5($strSecret) + $strSalt);
        }

        return $strSalt;
    }

    /**
     * returns the random bits for generating the Global unique id
     *
     * @return string the salt
     */
    private static function getSalt()
    {
        $strTime = microtime();
        $strRandom = rand(0, 32768);
        // same in MySql SELECT MD5(MD5(CONCAT(UNIX_TIMESTAMP(), '#',(FLOOR(0 +
        // RAND() * 32768)))))
        return md5($strTime . '#' . $strRandom);
    }

    /**
     * This method gives a predictable hash for the given value.
     * Optionally it calculates a secret into the hash, which will
     * be hashed before used to harden against attacks.
     *
     * @param $strValue string
     *            the payload to be hashed
     * @param $strSecret string
     *            optional salt
     */
    public static function getHash($strValue, $strSecret = null)
    {
        $strSalt = '';
        if($strSecret != null) {
            $strSalt = md5($strSecret);
        }
        return md5($strValue + $strSalt);
    }
}