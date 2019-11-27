<?php declare(strict_types=1);

/*************
 * Helper für Datums- und Zeitfunktionen
 *
 * @package  Common_Helper
 * @author Sven Schrodt
 *
 *
 **/
namespace P7Tools\Base\DateTime;
class DateTimeHelper
{

    const WRONG_ERROR_DATETIME_TYPE = 100;

    protected static $dbAdapter = null;

    /**
     * Calculating number of days in given month
     *
     * @param int $year
     * @param int $month
     * @return int
     */
    public static function getDaysInMonth($year, $month)
    {
        if(!is_int($year)) {
            throw new \InvalidArgumentException('$year muss vom Typ int sein');
        }
        if(!is_int($month)) {
            throw new \InvalidArgumentException('$year muss vom Typ int sein');
        }
        return (int) date('t', mktime(0, 0, 0, $month, 1, $year));
    }

    /**
     * Formatig DateTime string (YYY-mm-dd HH:MM:SS) to
     * german format
     *
     * @param string $dateTime
     * @param string $dateOnly
     * @return string
     */
    public static function formatIsoDateTimeToGermanDate($dateTime,
            $dateOnly = false)
    {
        list ($date, $time) = explode(' ', $dateTime);
        list ($year, $month, $day) = explode('-', $date);
        if ($dateOnly) {
            return "$day.$month.$year";
        } else {
            return "$day.$month.$year $time";
        }
    }

    /**
     * Gibt aktuelles Datum mit Zeit zurück
     *
     * @param string $format
     * @param string $type
     */
    public static function getNow($format = 'Y-m-d H:i:s', $type = 'plain')
    {
        switch (strtolower($type)) {
            case 'plain':
                return date($format);
                break;

            case 'zend_date':
                return new \Zend_Date();
                break;

            case 'datetime':
                    return new \DateTime();
                    break;
            default:

                throw new \InvalidArgumentException('Wrong date type: ' . $type,
                        self::WRONG_ERROR_DATETIME_TYPE);
        }
    }
}