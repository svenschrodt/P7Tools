<?php declare(strict_types=1);
/**
 * P7Tools\lib\Pattern\Behavior\Observer
 *
 * Defining API for classes implementing observer
 * Following subject/observer pattern (a.k.a. publish/subscribe)
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Pattern\Behavior;

interface Observer
{
    public function update(Observable $subject);
}