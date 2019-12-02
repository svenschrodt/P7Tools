<?php declare(strict_types = 1);
/**
 * P7Tools\Base\Data\Guid
 *
 * Generic class to create and handle globally unique identifiers
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Base\Data;

class Guid
{

    /**
     * Creating a 32 byte hexadecimal global unique ID
     *
     * @param string $strSecret
     * @return string
     */
    public static function getRandomGUID(string $strSecret = null): string
    {
        $strSalt = self::getSalt();

        if ($strSecret != null) {
            return md5(md5($strSecret) + $strSalt);
        }
        return $strSalt;
    }

    /**
     * Returning random bits for generating the Global unique id
     *
     * @return string the salt
     */
    private static function getSalt(): string
    {
        $strTime = microtime();
        $strRandom = rand(0, 32768);
        // same in MySql:
        // SELECT MD5(MD5(CONCAT(UNIX_TIMESTAMP(), '#',(FLOOR(0 + RAND() * 32768)))))
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
     *            
     * @return string hashed string
     */
    public static function getHash(string $strValue, string $strSecret = null): string
    {
        $strSalt = '';
        if ($strSecret != null) {
            $strSalt = md5($strSecret);
        }
        return md5($strValue + $strSalt);
    }
}