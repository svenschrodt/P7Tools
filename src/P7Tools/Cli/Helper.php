<?php
declare(strict_types = 1);
/**
 * P7Tools\CliHelper
 *
 * Function for shell usage
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-25
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Cli;

class Helper
{

    /**
     * Colour for foreground
     *
     * @var string
     */
    private $fgColour;

    /**
     * Colour for background
     *
     * @var string
     */
    private $gbColour;

    /**
     * Constructor function
     */
    public function __construct()
    {
        // Setting up shell colours
        $this->fgColour = [
            'black' => '0;30',
            'dark_gray' => '1;30',
            'blue' => '0;34',
            'light_blue' => '1;34',
            'green' => '0;32',
            'light_green' => '1;32',
            'cyan' => '0;36',
            'light_cyan' => '1;36',
            'red' => '0;31',
            'light_red' => '1;31',
            'purple' => '0;35',
            'light_purple' => '1;35',
            'brown' => '0;33',
            'yellow' => '1;33',
            'light_gray' => '0;37',
            'white' => '1;37'
        ];

        $this->gbColour = [
            'black' => '40',
            'red' => '41',
            'green' => '42',
            'yellow' => '43',
            'blue' => '44',
            'magenta' => '45',
            'cyan' => '46',
            'light_gray' => '47'
        ];
    }

    /**
     * Returning a coloured string
     *
     * @param string $string
     * @param string $fg
     * @param string $bg
     * @return string
     */
    public function getColouredString(string $string, string $fg = null, string $bg = null) : string
    {
        $cString = "";

        // Checking, if the given fg colour is found
        if (isset($this->fgColour[$fg])) {
            $cString .= "\033[" . $this->fgColour[$fg] . "m";
        }
        // Check if given background colour found
        if (isset($this->gbColour[$bg])) {
            $cString .= "\033[" . $this->gbColour[$bg] . "m";
        }

        // Add string and end colouring
        $cString .= $string . "\033[0m";

        return $cString;
    }

    /**
     * Returning foreground colour names
     *
     * @return array
     */
    public function getFgColours() : array
    {
        return array_keys($this->fgColour);
    }

    /**
     * Returning background colour names
     *
     * @return array
     */
    public function getBgColours() : array
    {
        return array_keys($this->gbColour);
    }
}