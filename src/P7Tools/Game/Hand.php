<?php declare(strict_types=1);
/**
 * Hand eq list of Card
 */
namespace P7Tools\Game;

use P7Tools\Base\Data\Symbol;

class Hand
{

    protected $_cards;

    public function __construct(array $cards)
    {
        $this->_cards = $cards;
    }

    public function sort()
    {
        $this->sortByOrder($this->_cards);
    }

    protected function sortByOrder(&$cards)
    {
        usort($cards, array(
            __CLASS__,
            '_compareCallback'
        ));
    }

    public function getCards() {
        return $this->_cards;
    }
    protected static function _compareCallback(Card $a, Card $b)
    {
        if ($a->getPositionOrder() == $a->getPositionOrder()) {
            return 0;
        }
        return ($a->getPositionOrder() < $b->getPositionOrder()) ? - 1 : 1;
    }

    public function __toString()
    {
        return implode(' ', $this->_cards);
    }
}