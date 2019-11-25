<?php
/**
 * P7Tools\Http\CooperationTest
 *
 * Testing co operating of HTTP components
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
namespace P7Tools;

class MetaTest extends \PHPUnit\Framework\TestCase
{

    protected $testContainer;

    public function setUp()
    {}

//     public function testLol()
//     {
// //         var_dump($_SERVER['PHPSERVER']);die;
//     }

    public function NOtestIfColoursAreShownCorrectly()
    {
        echo "\n";
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


    protected function santizeLongColour($string)
    {
        //var_dump(strstr('light_gray', '_'));die;
        if(strstr($string, '_')!==false) {
            $parts = explode('_', $string);
            $string = substr($parts[0], 0, 1);
            $string .= ucfirst($parts[1]);
        }

        return $string;
    }

    public function testIfConstantsAreSetCorrectly()
    {
        $this->assertTrue(is_string(Meta::PROJECT_REPOSITORY));
        $this->assertTrue(is_string(Meta::CI_PLATFORM));
    }

    public function testIfDebugModeStatusIsBoolean()
    {
        $this->assertTrue(is_bool(Meta::getDebugMode()));
    }

    public function testIfDebugModeStatusIsSetCorrectly()
    {
        Meta::setDebugMode(true);
        $this->assertTrue(Meta::getDebugMode());
        Meta::setDebugMode(false);
        $this->assertFalse(Meta::getDebugMode());
    }

    public function testIfEnvironmentIsSet()
    {
        $this->assertTrue(is_string(Meta::getEnvironment()));
    }

    public function testIfConstantsAreSet()
    {
        $this->assertTrue(is_array(Meta::getConstants()));
        $this->assertTrue(is_array(Meta::getConstants('USER')));
    }
}


