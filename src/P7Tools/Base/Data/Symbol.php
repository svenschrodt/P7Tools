<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\Base\Data\String
 *
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Base\Data;

class Symbol
{

    // simple symbols
    const SINGLE_QUOTE = "'";

    const DOUBLE_QUOTE = '"';

    const TICK = "´";

    const BACKTICK = "`";

    const DEFAULT_ASSIGNMENT_IDENTIFIER = ' = ';

    const ARRAY_ASSIGNMENT_IDENTIFIER = ' => ';

    const OPEN_PARENTHESIS = '(';

    const CLOSE_PARENTHESIS = ')';

    const OPEN_CROTCHET = '[';

    const CLOSE_CROTCHET = ']';

    const OPEN_BRACE = '{';

    const CLOSE_BRACE = '}';

    // operators
    const EQUALS = '==';

    const IS_IDENTICAL = '===';

    const LESS_THAN = '<';

    const GREATER_THAN = '>';

    const GREATER_THAN_OR_EQUALS = '>=';

    const LESS_THAN_OR_EQUALS = '<=';

    const NOT_EQUALS = '<>';

    const ANAKINS_SHIP = '<=>';

    // Card Suits
    const BLACK_SPADE_SUIT = '♠';

    const BLACK_HEART_SUIT = '♥';

    const BLACK_DIAMOND_SUIT = '♦';

    const BLACK_CLUB_SUIT = '♣';
}