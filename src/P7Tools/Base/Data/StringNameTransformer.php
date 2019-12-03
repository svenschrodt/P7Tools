<?php
declare(strict_types = 1);
/**
 * \P7Tools\Base\Data\StringNameTransformer
 *
 * Transforming between different string naming conventions:
 *
 * - camelCase
 * - Camelcase
 * - snake_case
 *
 * @todo recognizing current convention types
 *      
 *       !Do not use in production until it is stable!
 *      
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-03
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Base\Data;

class StringNameTransformer
{

    /**
     * Splitting string at Uppercased substrings
     *
     * @param string $string
     * @return array
     */
    public static function explodeUpperCaseSubstring(string $string): array
    {
        return preg_split('/(?=[A-Z])/', $string, - 1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Splitting string at boudary sub string (default: Symbol::SINGLE_UNDERSCORE)
     * into substrings
     *
     * @param string $string
     * @return array
     */
    public static function explodeAtBoundary(string $string, string $boundary = Symbol::SINGLE_UNDERSCORE): array

    {
        return explode($boundary, $string);
    }

    /**
     * Getting camelCased | CamelCased string from string with common boundary sub string
     *
     * @param string $string
     * @param string $boundary
     * @return string
     */
    public static function getcamelCasedString(string $string, bool $upperFirst = false, string $boundary = Symbol::SINGLE_UNDERSCORE)
    {
        $tmp = self::explodeAtBoundary($string, $boundary);

        for ($i = 0; $i < count($tmp); $i ++) {
            $tmp[$i] = ucfirst(strtolower($tmp[$i]));
        }
        $glued = implode('', $tmp);
        return ($upperFirst) ? $glued : lcfirst($glued);
    }
}
