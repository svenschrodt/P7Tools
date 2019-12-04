<?php

declare(strict_types = 1);
/**
 * P7Tools\Base\Type\TypeInterface
 *
 * Abstract foundation class for classes representing scalar types and operations on it
 *
 * !Do not use in production until it is stable!
 *
 * @todo Add methods, whenever another string* functionality is needed in project development
 *      
 *      
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Base\Type;
use P7Tools\Tools\ValidatorInterface;

abstract class AbstractType
{

    /**
     * Value of current instance
     *
     * @var mixed
     */
    protected $_value;

    /**
     * Generic validator function uses external validator classes implementing
     * \P7Tools\Tools\ValidatorInterface
     *
     * @param ValidatorInterface $validator
     * @return bool
     */
    public function validatesTo(ValidatorInterface $validator): bool
    {
        // Validating value ! instance itself
        return  $validator->isValid($this->get());
    }
        
} 