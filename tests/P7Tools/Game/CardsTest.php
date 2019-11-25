<?php
/**
 *
 *
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Game;

use P7Tools\Base\Data\ArrayHelper;
use P7Tools\Dev\CodeCreator;
use P7Tools\Base\Data\Symbol;
use P7Tools\Dev\Expression;
use P7Tools\Game\Card;

class CardsTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function testFooMockSupressingErrorMesg()
    {
        $this->assertFalse(3==7);
    }
    
    public function NotestIfQueriessAreSetCorrectly()
    {
        $no = 4;
        $deck = Deck::getCards($no);
        //var_dump($deck);die;
        $hand=new Hand($deck);
        //var_dump($hand->getCards());
        echo PHP_EOL;
        echo $hand;

        echo PHP_EOL;
        foreach ($hand->getCards() as $number => $card) {
            echo implode(' ', array(
                $card->getShortName(),
                $card->getPositionOrder(),
                $number,
                PHP_EOL
            ));
        }
        $hand->sort();
        echo $hand;
        echo PHP_EOL . "Now sorted".PHP_EOL;
        //var_dump($hand->getCards());
        foreach ($hand->getCards() as $number => $card) {
            echo implode(' ', array(
                            $card->getShortName(),
                            $card->getPositionOrder(),
                            $number,
                            PHP_EOL
                        ));
        }
        for ($i = 0; $i < $no; $i ++) {

            echo implode(' ', array(
                $deck[$i]->getSuit(),
                $deck[$i]->getName(),
                $deck[$i]->getPositionOrder(),
                $deck[$i]->getShortName(),
                get_class($deck[$i]),

                PHP_EOL
            ));
        }

        // var_dump($deck);

        // $cards = new Cards();
        // for($i=32;$i<256;$i++) {
        // echo implode('', array('(',$i,':',chr($i), ')'));
        // }

        // $card = new Card('A', 'spADEs');
        // echo $card->getFullName();
        // echo $cards->getCardName('Q');
        // echo $cards->getSymbol('diamonds');
        // echo ArrayHelper::getArrayAsString($data, true);
    }
}


