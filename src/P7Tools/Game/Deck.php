<?php declare(strict_types=1);
namespace P7Tools\Game;

use P7Tools\Base\Data\Symbol;

class Deck
{

    const NOT_AVAILABLE = 'N/A';

    protected static $_types = array(

        // 1 => 'One',
        // 2 => 'Two',
        // 3 => 'Three',
        // 4 => 'Four',
        // 5 => 'Five',
        // 6 => 'Six',
        7 => 'Seven',8 => 'Eight',9 => 'Nine',10 => 'Ten','J' => 'Jack','Q' => 'Queen','K' => 'King','A' => 'Ace'
    );

    protected static $_suits = array(
        'Diamonds' => Symbol::BLACK_DIAMOND_SUIT,
        'Hearts' => Symbol::BLACK_HEART_SUIT,
        'Spades' => Symbol::BLACK_SPADE_SUIT,
        'Clubs' => Symbol::BLACK_CLUB_SUIT
    );

    public static function getTypes()
    {
        return self::$_types;
    }

    public static function getKeys()
    {
        return array_keys(self::$_types);
    }

    public static function getSuits()
    {
        return array_keys(self::$_suits);
    }

    public static function getCardName($key)
    {
        $key = strtoupper($key);
        return (isset(self::$_types[$key])) ? self::$_types[$key] : null;
    }

    public static function getSymbol($name)
    {
        $name = ucfirst(strtolower($name));
        // echo PHP_EOL . "[$name]".PHP_EOL;
        return (isset(self::$_suits[$name])) ? self::$_suits[$name] : self::NOT_AVAILABLE;
    }

    public static function getCards($number = 10, $deck = false)
    {
        if (! is_array($deck)) {
            $deck = self::getFullDeck(false);
        }
        $cards = array();
        $drawn = array_rand($deck, $number);
        for ($i = 0; $i < $number; $i ++) {
            $cards[] = $deck[$drawn[$i]];
        }
        return $cards;
    }

    public static function isValidKey($key)
    {
        return isset(self::$_types[$key]);
    }

    public static function getFullDeck($sectioned = true)
    {
        $fulldeck = array();
        foreach (self::getSuits() as $suit) {
            if ($sectioned) {
                $fulldeck[] = self::getSuit($suit);
            } else {
                $fulldeck = array_merge($fulldeck, self::getSuit($suit));
            }
        }
        return $fulldeck;
    }

    public static function getSuit($name)
    {
        $suit = array();
        foreach (self::getTypes() as $type => $value) {
            $suit[] = new Card($type, $name);
        }
        return $suit;
    }
}