<?php declare(strict_types=1);
/**
 * P7Tools\Game\Card
 *
 * Class representing single card 
 *
 * !Do not use in production until it is stable!
 *
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2015-11-22
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */

// GErman hint: Kreuz = Clubs =>'', Pik = Spades =>'',
// Herz = Hearts =>'', Karo = Diamonds. W
// erte: Ass = Ace =>'', König = King =>'',
// Dame = Queen =>'', Bube = Jack =>'',
// 10 bis 7 wie die englischen Worte für diese Zahlen.
namespace P7Tools\Game;

class Card
{

    protected $_suit;

    protected $_type;

    protected $_isTrump;

    protected $_deck;

    protected $_shortType;

    public function __construct($type, $suit, $isTrump = false)
    {
        $this->_isTrump = $isTrump;
        $type = ucfirst(strtolower($type));
        $this->_shortType = $type;
        $suit = ucfirst(strtolower($suit));
        $this->_suit = (in_array($suit, Deck::getSuits())) ? $suit : Deck::NOT_AVAILABLE;
        $this->_type = (array_key_exists($type, Deck::getTypes())) ? Deck::getCardName($type) : Deck::NOT_AVAILABLE;
    }

    /**
     * Getting (relative) Position
     *
     * @return Ambigous <>
     */
    public function getPositionOrder()
    {
        // just the keys
        $types = array_keys(Deck::getTypes());
        // position of key, where key $this->_shortType
        $order = array_keys($types, $this->_shortType);
        return $order[0];
    }

    public function getName()
    {
        return $this->_type;
    }

    public function getFullName()
    {
        return $this->_type . ' of ' . $this->_suit;
    }

    public function getShortName()
    {
        return $this->_shortType . Deck::getSymbol($this->_suit);
    }

    public function getSuit()
    {
        return $this->_suit;
    }

    /**
     * Getting info, if current instance is a trump (not Donald, nor president)
     * 
     * @return boolean|string
     */
    public function isTrump() : bool
    {
        return $this->_isTrump;
    }

    /**
     * Setting current instance as trump (not Donald, nor president)
     *
     * @return Card
     */
    public function setTrump()
    {
        $this->_isTrump = true;
        return $this;
    }

    /**
     * 
     */
    public function unsetTrump()
    {
        $this->_isTrump = false;
    }

    public function __toString()
    {
        return sprintf('%5s', $this->getShortName());
    }


}