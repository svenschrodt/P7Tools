<?php declare(strict_types = 1);

/** Helper functions for Date / Time
 *
 * @package Common_Helper
 * @author Sven Schrodt
 *        
 *        
 */
namespace P7Tools\Base\DateTime;

class DateTimeHelper
{

    /**
     * Error code for unknown date/time error type
     * 
     * @var integer
     */
    const WRONG_ERROR_DATETIME_TYPE = 666;

    /**
     * Calculating number of days in given month
     *
     * @param int $year
     * @param int $month
     * @return int
     */
    public static function getDaysInMonth(int $year, int $month)
    {
        return date('t', mktime(0, 0, 0, $month, 1, $year));
    }

    /**
     * Formating DateTime string (YYY-mm-dd HH:MM:SS) to
     * german format
     *
     * @param string $dateTime
     * @param string $dateOnly
     * @return string
     */
    public static function formatIsoDateTimeToGermanDate($dateTime, $dateOnly = false)
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
     * Returning current date / time as ISO formatted string
     *
     * @param string $format
     * @param string $type
     * @return string | \DateTime
     */
    public static function getNow(string $format = 'Y-m-d H:i:s', string $type = 'plain')
    {
        switch (strtolower($type)) {
            case 'plain':
                return date($format);
                break;

            case 'datetime':
                return new \DateTime();
                break;
   
            default:

                throw new \InvalidArgumentException('Wrong date type: ' . $type, self::WRONG_ERROR_DATETIME_TYPE);
        }
    }
}