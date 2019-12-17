<?php  declare(strict_types = 1);

/**
 * Class for exceptions to be thrown during SQL string generation
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net> */
namespace P7Tools\Database\Sql;

class SqlException extends \ErrorException
{

    /**
     * @ var string
     */
    const NO_CONDITION_FOUND_YET = 'No condition found to match with';

}