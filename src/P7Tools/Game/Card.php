<?php declare(strict_types=1);
// Farben: Kreuz = Clubs =>'', Pik = Spades =>'',
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

    public function isTrump()
    {
        return $this->_isTrump;
    }

    public function setTrump()
    {
        $this->_isTrump = true;
    }

    public function unsetTrump()
    {
        $this->_isTrump = false;
    }

    public function __toString()
    {
        return sprintf('%5s', $this->getShortName());
    }


}