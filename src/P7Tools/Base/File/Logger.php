<?php declare(strict_types=1);

/**
 * \Base\File\Logger
 *
 * <code>
 * $logger = new Logger();
 * $logger->info('f00 initialized');
 * $logger->err('SQL 128793 - parse error');
 * $logger->debug('$a = 0.0001');
 * $logger->crit('System load: 99.99999%');
 * $logger->notice('btw...);
 * $logger->emerg('Emergency...');
 * $logger->alert('Alert');
 * $logger->warn('Warning: ...');
 * </code>
 *
 * !Do not use in production until it is stable!
 *
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 */
namespace \Base\File;

class Logger
{

    // Log Level according to Request for Comments: 3164 "The BSD syslog
    // Protocol"

    // Emergency: system is unusable
    const EMERG = 0;
    // Alert: action must be taken immediately
    const ALERT = 1;
    // Critical: critical conditions
    const CRIT = 2;
    // Error: error conditions
    const ERR = 3;
    // Warning: warning conditions
    const WARN = 4;
    // Notice: normal but significant condition
    const NOTICE = 5;
    // Informational: informational messages
    const INFO = 6;
    // Debug: debug-level messages
    const DEBUG = 7;

    // Status für Dateinamen und Log-Level-Einträge in Log-Files
    protected static $_status = array('EMERG','ALERT','CRIT','ERR','WARN','NOTICE','INFO','DEBUG');

    // Verzeichnis für Logdateien der Anwendung
    protected static $_logDir = '/var/log/application/';

    /**
     * Generic Logging method
     *
     *
     * @param string $message
     * @param int $level
     */
    protected static function _log($message, $level = self::ERR)
    {
        $o = self::_getNamePartsNow($level);
        error_log($o->linePrefix . $message . PHP_EOL, 3, $o->fileName);
    }

    /**
     * Helper function for naming files, creating timestamp
     *
     * @param int $level
     * @return stdClass
     */
    protected static function _getNamePartsNow($level = self::ERR)
    {
        $now = date('Y-m-d H:i:s');
        $remote = (isset($_SERVER['REMOTE_ADDR'])) ? "[{$_SERVER['REMOTE_ADDR']}]" : "[N/A]";
        // 20160602
        $fileFix = substr(str_replace(array('-',' ',':'), '', $now), 0, 8);
        $o = new \stdClass();
        $o->status = self::$_status[$level];
        $o->fileName = self::$_logDir . "proweb_{$fileFix}.log";
        $o->linePrefix = "$now $remote " . str_pad("[{$o->status}]", 8, ' ', STR_PAD_RIGHT);
        return $o;
    }

    /**
     * Magical interceptor method ()
     *
     * @param string $method
     * @param array $params
     */
    public function __call($method, $params)
    {
        $key = array_search(strtoupper($method), self::$_status);
        if($key) {
            self::_log($params[0], $key);
        } else {
            //@TODO Error Handling
        }
    }

    /**
     * Methode mit Prüfung auf schreibbare Zieldatei
     *
     * @param string $file
     * @param string $message
     */
    public static function safeLog($file, $message)
    {
        if(is_writable($file)) {
            file_put_contents($file, $message, FILE_APPEND);
        } else {
            self::_log("Die Datei $file  ist nicht schreibbar!");
        }
    }
}