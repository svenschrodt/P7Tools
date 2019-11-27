<?php

declare(strict_types = 1);
/**
 * P7Tools\Game\Hand
 *
 * Class representing list of cards in 'a hand' of player
 *
 * !Do not use in production until it is stable!
 *
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Game;

use P7Tools\Base\Data\Symbol;

class Hand
{

    /**
     * Array containing current 'hand'
     *
     * @var array
     */
    protected $_cards = array();

    /**
     * Constructor function
     *
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->_cards = $cards;
    }

    /**
     * Sorting 'hand'
     *
     * @param string $order
     */
    public function sort(string $order = 'DESC'): void
    {
        $this->sortByOrder($this->_cards, $order);
    }

    /**
     * Iternal function to sort cards by given order
     *
     * @param array $cards
     */
    protected function sortByOrder(array &$cards, string $order)
    {
        usort($cards, array(
            __CLASS__,
            '_compareCallback'
        ));
    }

    /**
     * Getting list of cards in curret order
     *
     * @return array
     */
    public function getCards()
    {
        return $this->_cards;
    }

    /**
     * Internal callback function compairing a pair of neighboured cards
     *
     * @param Card $a
     * @param Card $b
     * @return int
     */
    protected static function _compareCallback(Card $a, Card $b): int
    {
        if ($a->getPositionOrder() == $a->getPositionOrder()) {
            return 0;
        }
        return ($a->getPositionOrder() < $b->getPositionOrder()) ? - 1 : 1;
    }

    /**
     * Magical interceptor function returning string reperesentation
     * of current 'hand'
     *
     * @return string
     */
    public function __toString(): string
    {
        return implode(' ', $this->_cards);
    }
}