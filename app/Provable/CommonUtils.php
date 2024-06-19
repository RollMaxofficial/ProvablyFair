<?php

namespace App\Provable;


/**
 * A utility class providing common methods.
 */
class CommonUtils {

    /**
     * Generate random numbers.
     *
     * @param string $hmac HMAC value
     * @param int $seed Seed value
     * @return int Generated random number
     */
    public static function generateRandomNumbers(string $hmac, int $seed): int {
        // Use HMAC value to generate random numbers
        $sum = array_reduce(range(0, 3), function ($carry, $i) use ($hmac) {
            // Convert every two characters to hexadecimal and then to decimal
            $decimalValue = hexdec(substr($hmac, $i * 2, 2));
            // Calculate partial sum for random numbers
            return $carry + number_format($decimalValue / (256 ** ($i + 1)), 12);
        }, 0);
        // Multiply the partial sum by the seed value and convert it to an integer as the final random number
        return (int)($sum * $seed);
    }

    /**
     * Fisher-Yates shuffle algorithm.
     *
     * @param array $array Array to be shuffled
     * @param string $hmac HMAC value
     * @param int $num Number of shuffles
     * @return array Shuffled array
     */
    public static function fisherYatesShuffle(array $array, string $hmac, int $num): array {
        $length = count($array);

        for ($i = 0; $i < $length  - 1; $i++) {
            // Generate random number
            $random = self::generateRandomNumbers(substr($hmac, $i*8) , $length - $i);

            // Swap array elements
            $temp = $array[$i+ $random];
            // Remove the swapped element from its current position in the array
            unset($array[$i+ $random]);
            // Insert the swapped element at position $i in the array
            array_splice($array, $i, 0, $temp);
            // Reindex the array after the splice operation
            $array = array_values($array);
        }
        // Return the first $num elements of the shuffled array
        return array_slice($array, 0, $num);  
    }

    /**
     * Generate HMAC value.
     *
     * @param string $serverSeed Server seed
     * @param string $clientSeed Client seed
     * @param int $hmacNum Number of HMAC iterations
     * @return string HMAC value
     */
    public static function generateHmac(string $clientSeed, string $serverSeed, int $hmacNum): string {
        // Initialize HMAC with server seed and client seed
        $hmac = hash_hmac('sha256', $clientSeed, $serverSeed);
        // Prepare client seed for subsequent iterations
        $lastColonPosition = strrpos($clientSeed, ":");
        $trimmedString = substr($clientSeed, 0, $lastColonPosition + 1);
        // Iterate to generate HMAC for subsequent iterations
        for ($i = 1; $i < $hmacNum; $i++) {
            $clientSeed = $trimmedString . $i;
            $hmac .= hash_hmac('sha256', $clientSeed, $serverSeed);
        }
        // Return the resulting HMAC value
        return $hmac;
    }


}
