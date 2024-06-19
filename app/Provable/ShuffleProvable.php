<?php

namespace App\Provable;


/**
 * Class ShuffleProvable
 * This class implements the ShuffleProvableInterface and provides methods for shuffling arrays.
 */
class ShuffleProvable implements ShuffleProvableInterface
{
   
    /**
     * Client seed.
     * @var string
     */
    private $clientSeed;

    /**
     * Server seed.
     * @var string
     */
    private $serverSeed;

    /**
     * Min value. Default is 0.
     * @var int
     */
    private $min;

    /**
     * Max value. Default is 24.
     * @var int
     */
    private $max;

    /**
     * Number of cards to deal. Default is 20.
     * @var int
     */
    private $numOfCardsToDeal;
    

    /**
     * Class constructor.
     * @param string|null $clientSeed The client seed
     * @param string|null $serverSeed The server seed
     * @param int|null $min The minimum value
     * @param int|null $max The maximum value
     */
    public function __construct( ?string $clientSeed = null, ?string $serverSeed = null,?int $type)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setMin();
        $this->setMax();
        $this->setNumOfCardsToDeal();
    }

    /**
     * Static constructor.
     * @param string|null $clientSeed The client seed
     * @param string|null $serverSeed The server seed
     * @return ShuffleProvableInterface
     */
    public static function init(?string $clientSeed = null, ?string $serverSeed = null,?int $type= null): ShuffleProvableInterface
    {
        return new static($clientSeed, $serverSeed,$type);
    }

    /**
     * Set the client seed.
     * @param string|null $clientSeed The client seed
     * @return ShuffleProvableInterface
     */
    public function setClientSeed(?string $clientSeed = null): ShuffleProvableInterface
    {
        $this->clientSeed = $clientSeed ?? $this->generateRandomSeed();
        return $this;
    }

    /**
     * Get the client seed.
     * @return string
     */
    public function getClientSeed(): string
    {
        return $this->clientSeed;
    }

    /**
     * Set the server seed.
     * @param string|null $serverSeed The server seed
     * @return ShuffleProvableInterface
     */
    public function setServerSeed(?string $serverSeed = null): ShuffleProvableInterface
    {
        $this->serverSeed = $serverSeed ?? $this->generateRandomSeed();
        return $this;
    }

    /**
     * Get the server seed.
     * @return string
     */
    public function getServerSeed(): string
    {
        return $this->serverSeed;
    }

    /**
     * Set the minimum value.
     * @param int|null $min The minimum value
     * @return ShuffleProvableInterface
     */
    public function setMin(?int $min = null): ShuffleProvableInterface
    {
        $this->min = $min ?? 0;
        return $this;
    }

    /**
     * Get the minimum value.
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * Set the maximum value.
     * @param int|null $max The maximum value
     * @return ShuffleProvableInterface
     */
    public function setMax(?int $max = null): ShuffleProvableInterface
    {
        $this->max = $max ?? 24;
        return $this;
    }

    /**
     * Get the maximum value.
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set the number of cards to deal.
     * @return ShuffleProvableInterface
     */
    public function setNumOfCardsToDeal(?int $numOfCardsToDeal = null): ShuffleProvableInterface
    {
        $this->numOfCardsToDeal=$numOfCardsToDeal ?? $this->max - $this->min + 1;
        return $this;
    }

    /**
     * Get the number of cards to deal.
     * @return int
     */
    public function getNumOfCardsToDeal(): int
    {
        return $this->numOfCardsToDeal;
    }

    /**
     * Generate a random seed.
     * @return string
     */
    private function generateRandomSeed(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    /**
     * Get the hashed server seed.
     * @return string
     */
    public function getHashedServerSeed(): string
    {
        return hash('sha256', $this->serverSeed);
    }

    /**
     * Generate the result of the shuffle operation.
     * @return array The result of the shuffle operation
     */
    public function results(): array
    {
        try {
            return  $this->shuffle();
        } catch (\Exception $e) {
            // If any exception occurs, return error with error message
            return null;
        }
    }

    /**
     * Shuffle the array of integers using HMAC-based shuffling algorithm.
     * @return array The shuffled array
     */
    public function shuffle(): array
    {
        // Generate an array of integers from min to max
        $array = range($this->getMin(), $this->getMax());
        $length = $this->getNumOfCardsToDeal();

        // Calculate the number of HMAC iterations
        $hmacNum = ceil(($length - 1) / 8);

        // Generate HMAC
        $hmac = CommonUtils::generateHmac($this->getClientSeed(), $this->getServerSeed(), $hmacNum);

        // Shuffle the array
        $array = CommonUtils::fisherYatesShuffle($array, $hmac, $length);

        // Prepare result array with x and y coordinates
        return $array;
    }

}
