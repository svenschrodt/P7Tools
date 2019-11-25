<?php
/**
 * P7Tools\Dev\MockTest
 *
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools\Dev;

class MockTest extends \PHPUnit\Framework\TestCase
{


    public function testFooMockSupressingErrorMesg()
    {
        $this->assertFalse(3==7);
    }
    public function NOtestBofhExcuses()
    {
       $excuses = Mock::excusesFromBofH();

       for($i=0;$i<23;$i++) {
            echo $excuses[array_rand($excuses,1)] . PHP_EOL;
       }
    }


public function NotestIfColoursAreShonCorrectly()
    {
//         echo "\n";
        $string = 'Lorem Ipsum';
        $ch = new \P7Tools\Cli\Helper();
        $fg = array(
            'black',
            'dark_gray',
            'blue',
            'light_blue',
            'green',
            'light_green',
            'cyan',
            'light_cyan',
            'red',
            'light_red',
            'purple',
            'light_purple',
            'brown',
            'yellow',
            'light_gray',
            'white'
        );

        $bg = array('black','red','green','yellow','blue','magenta','cyan','light_gray');

        foreach ($bg as $b) {
            foreach ($fg as $f) {
                $fs= $this->santizeLongColour($f);
                $bs= $this->santizeLongColour($b);
                echo $ch->getColouredString(" [$fs@$bs] ", $f, $b);
            }
            echo "\n";
        }


        echo "\n";
    }


    protected function NosantizeLongColour($string)
    {
        //var_dump(strstr('light_gray', '_'));die;
        if(strstr($string, '_')!==false) {

            $parts = explode('_', $string);
            $string = substr($parts[0], 0, 1) . ucfirst($parts[1]);
        }

        return $string;
    }



    public function NotestSuperGlobalServer()
    {
        $this->assertTrue(is_string($_SERVER['REQUEST_URI']));
    }


}