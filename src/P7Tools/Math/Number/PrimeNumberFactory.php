<?php
declare(strict_types = 1);
/**
 * \P7Tools\Math\Number\PrimeNumberFactory
 *
 * Factory to calculate prime numbers
 *
 *
 * @todo Rewrite !
 * 
 * !Do not use in production until it is stable!
 *      
 *      
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-12-03
 * @link https://github.com/svenschrodt/P7Tools
 * @used-by StringClass
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7Tools\Math\Number;

class PrimeNumberFactory
{

    /**
     * Naive implementation with arrays ->
     *
     * @todo implement returnning genaretors --> yield
     *      
     * @param int $limit
     * @return array
     */
    public function sieveofEratosthenes($limit)
    {
        /**
         * Initializing range of numbers [2 ..
         * $limit]
         *
         * @hint 1 is NOT a prime number by definition
         *
         * @var integer $number
         */
        $number = 2;

        $range = range(2, $limit);

        $primes = array_combine($range, $range);

        // Loop through the numbers and remove the multiples off array
        while ($number * $number < $limit) {
            for ($i = $number; $i <= $limit; $i += $number) {
                if ($i == $number) {
                    continue; // leave loop
                } // delete element NOT being a PN
                unset($primes[$i]);
            }
            $number = next($primes);
        }
        return $primes;
    }


}