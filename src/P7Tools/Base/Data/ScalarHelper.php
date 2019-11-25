<?php declare(strict_types=1);

/**
 * Static helper methods for scalars
 *
 * @package P7Tools
 * @author Sven Schrodt
 * @since 2015-04-03
 */
namespace P7Tools\Base\Data;
use P7Tools\Base\Data\TypeValidator;
class ScalarHelper
{

    /**
     * Swapping values of variables $a und $b
     *
     * @param mixed $a
     * @param mixed $b
     * @param string $strict
     */
    public static function swapValues(&$a, &$b, $strict = false)
    {
        if ($strict) {
            TypeValidator::validateAsType($a, 'scalar');
            TypeValidator::validateAsType($b, 'scalar');
        }
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }
}