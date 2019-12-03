<?php declare(strict_types=1);

/**
 * \P7Tools\Base\Data\ArrayHandler 
 * 
 * Class handling fluent operations on multi dimensional arrays
 * with optional history and undo functionality
 *
 * Inline example
 * <code>
 * $ah = new ArrayHandler($data);
 * $ah->begins('name' , 'Fr') // filtering element with key 'name' begings with 'Fr'
 *    ->sort('id', 'DESC'); // sorting by element with key 'id' descending
 *
 * //undo two last operations and filtering element with key 'id' maximum value
 * $ah->rollBack()->rollBack()->max('account')
 *    ->sort('id', 'DESC');
 * </code>
 *
 * @author Sven Schrodt
 * @since 2015-10-02
 */
namespace P7Tools\Base\Data;

class ArrayHandler extends MultiArrayObject
{
}

