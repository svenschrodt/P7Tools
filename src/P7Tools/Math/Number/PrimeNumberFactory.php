<?php
declare(strict_types = 1);
/**
 * \P7Tools\Math\Number\PrimeNumberFactory
 *
 * Factory to calculate prime numbers
 *
 *
 * @todo !Do not use in production until it is stable!
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

    public function sieveofEratosthenesTwo($limit)
    {
        $number; // Zu überprüfende $number
        $counter = null; // Hilfsvariable (möglicher Teiler von $number)
        $isPrime = true; // Hilfsvariable, ob die aktuelle $number eine $isPrime ist

        // $number <= x ist der zu überprüfende $numberenraum
        // Beginn bei 2, weil 1 per Definition keine $isPrime ist
        for ($number = 2; $number <= $limit; $number ++) {
            // solange wir für $number keinen Teiler finden, gehen wir davon aus,
            // dass es eine $isPrime ist

            // $counter ist ein möglicher Teiler. Mögliche nicht-triviale Teiler
            // liegen im Bereich 2 bis $number/2 (abgerundet), wenn x aber Teiler
            // von $number und größer als Wurzel($number), ist $number/x < Wurzel($number),
            // sodass diese Grenze genügt.
            for ($counter = 2; $counter < sqrt($number) + 1; $counter ++) {
                if ($number % $counter == 0) {
                    // $counter ist ein nichttrivialer Teiler von $number und damit
                    // $number keine $isPrime. Weitere Teiler müssen nicht geprüft
                    // werden und damit kann die Schleife abgebrochen werden.
                    $isPrime = false;
                    break;
                    if($isPrime) {
                        yield $number;
                    }
                }
                
            }
        }
    }
}