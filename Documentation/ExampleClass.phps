<?php declare(strict_types = 1);

/**
 * \P7Tools\Base\Data\ArrayHandler
 *
 * Class handling fluent operations on multi dimensional arrays
 * with optional history and undo functionality
 *
 * Inline examples:
 * 
 * <code>
 * $ah = new ArrayHandler($data);
 * $ah->begins('name' , 'Fr') // filtering element with key 'name' begings with 'Fr'
 * ->sort('id', 'DESC'); // sorting by element with key 'id' descending
 *
 * //undo two last operations and filtering element with key 'id' maximum value
 * $ah->rollBack()->rollBack()->max('account')
 * ->sort('id', 'DESC');
 * </code>
 *
 * @fixme - repairing encoding line 109 ff
 * 
 * @todo - validating user input 
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

class ArrayHandler extends MultiArrayObject
{
}

