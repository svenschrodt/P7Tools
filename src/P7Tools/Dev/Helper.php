<?php declare(strict_types=1);
/**
 * P7Tools\Dev\Helper
 *
 * !Do not use in production until it is stable!
 *
 * @link https://github.com/svenschrodt/P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace P7Tools\Dev;

class Helper
{


    /**
     * Enabling error reporting 
     * @TODO use difernet levels
     * 
     */
    public static function enableErrorReporting() : void
    {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }
    
    /**
     * Returning (debugging) information about given object
     *
     * @param $object
     * @param bool $trace
     * @param bool $html
     * @return mixed
     */
    public static function getInfo($object, $trace = false, $inHtml = false)
    {
        //TODO -> check if executed in web context or via CLI
        $info = '';
        if ($inHtml) {
            $info .= "<pre>\n";
        }
        $info .= var_export($object, true);
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
     * @param $object
     * @param bool $stop
     */
    public static function printInfo($object, $stop = false, $inHtml = false)
    {
        print self::getInfo($object, false, $inHtml);
        if ($stop) {
            $traceInfo = debug_backtrace(1);
            //var_dump($traceInfo);
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
            //echo '<pre>';
            //  print_r($traceInfo);
            //    echo  '</pre>';
        }
        //return $info;
        die('Stopped in ' . $traceInfo[0]['file'] . ' line ' . $traceInfo[0]['line']);
    }

    public static function startMeasure()
    {
        return microtime(true);
    }

    public static function stopMeasure($startTime)
    {
        return (microtime(true) - $startTime);
    }
    
    public static function dumpCode($code)
    {
        
    }
    
} 