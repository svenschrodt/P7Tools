<?php declare(strict_types=1); declare(strict_types=1);
/**
 * P7Tools\lib\Pattern\Behavior\Observable
 *
 * Defining API for classes implementing subject (observable)
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

interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}