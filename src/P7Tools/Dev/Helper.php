<?php declare(strict_types = 1);
/**
 * P7Tools\Dev\Helper
 *
 * Static helper functions useful for development and debugging
 *
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-06
 * @link https://github.com/svenschrodt/P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Dev;

class Helper
{

    /**
     * Enabling error reporting
     * For DEV and start: full take;-)
     *
     * @todo use different levels
     *      
     */
    public static function enableErrorReporting(): void
    {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }

    /**
     * Returning (debugging) information about given
     * object (meaning: variable, data structure, array or objects)
     *
     * @param $object
     * @param bool $trace
     * @param bool $html
     * @return mixed
     */
    public static function getInfo($object, $trace = false, $inHtml = false)
    {
        // TODO -> check if executed in web context or via CLI
        $info = '';
        if ($inHtml) {
            $info .= "<pre>\n";
        }
        // we want var_dump insted of var_export, so we use output buffering here
        ob_start();
        var_dump($object, true);
        $info .= ob_get_contents();
        ob_end_clean();
        if ($inHtml) {
            $info .= "</pre>\n";
        }
        if ($trace) {
            if ($inHtml) {
                $info .= '<pre>';
            }
            print_r(debug_backtrace(1));
            if ($inHtml) {
                $info .= '</pre>';
            }
        }
        return $info;
    }

    /**
     * Printing (debugging) information to STDOUT
     *
     * @param mixed $object
     * @param bool $stop
     */
    public static function printInfo($object, $stop = false, $inHtml = false)
    {
        print self::getInfo($object, false, $inHtml);
        if ($stop) {
            $traceInfo = debug_backtrace(1);
            // var_dump($traceInfo);
            die('Stopped in ' . $traceInfo[0]['file'] . ' line ' . $traceInfo[0]['line']);
        }
    }

    /**
     * Stopping current script's execution and optional output of backtrace
     * debugging information
     *
     * @param bool $trace
     */
    public static function stop($trace = false)
    {
        if ($trace) {
            $traceInfo = debug_backtrace(1);
            // echo '<pre>';
            // print_r($traceInfo);
            // echo '</pre>';
        }
        // return $info;
        die('Stopped in ' . $traceInfo[0]['file'] . ' line ' . $traceInfo[0]['line']);
    }

    /**
     * Starting counter for measuring run times
     * returning current micro time
     *
     * @return int
     */
    public static function startMeasure(): int
    {
        return microtime(true);
    }

    /**
     * Stoppig counter and returning run time
     *
     * @param int $startTime
     * @return int
     */
    public static function stopMeasure(int $startTime): int
    {
        return (microtime(true) - $startTime);
    }
} 