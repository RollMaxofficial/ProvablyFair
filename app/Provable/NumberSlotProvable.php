<?php

namespace App\Provable;


/**
 * Class NumberSlotProvable
 * This class generates  3-digit 0-9 random numbers based on serverSeed and clientSeed.
 */
class NumberSlotProvable  extends Provable
{


    /**
     * Number of random numbers
     * @var int
     */
    private $numbers =3;

    /**
     * Multiplier.
     * @var int
     */
    private $seed = 10;
   


     /**
     * Class constructor.
     * @param string|null $clientSeed
     * @param string|null $serverSeed
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
    }
    
    /**
     * random integer array .
     * @return array
     */
    public function results(): array
    {
        return $this->generateRandomIntegerArray();
    }

    /**
     * Generate an array of random integers
     *
     * @return array The array of random integers
     */
    private function generateRandomIntegerArray(): array
    {
        // Generate HMAC using provided key and data
        $hmac = hash_hmac('sha256', $this->getClientSeed(),   $this->getServerSeed());
        
        // Use array_reduce to generate an array of random integers
        $result = array_reduce(range(0, $this->numbers - 1), function ($carry, $i) use ($hmac) {
            // Extract a portion of HMAC and convert it to decimal value
            $random=CommonUtils::generateRandomNumbers(substr($hmac, $i*8),$this->seed);
            $carry[] = $random;
            return $carry;
        }, []);
        
        // Return the resulting array of random integers
        return $result;
    }


}
