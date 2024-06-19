<?php

namespace App\Provable;

/**
 * Class DarganTower
 * Generates a two-dimensional array based on the input type.
 * - When type=1, generates a two-dimensional array with a length of 9, with each sub-array having a length of 3.
 * - When type=2, generates a two-dimensional array with a length of 9, with each sub-array having a length of 2.
 * - When type=3, generates a two-dimensional array with a length of 9, with each sub-array having a length of 1.
 * - Otherwise, generates a two-dimensional array with a length of 6, with each sub-array having a length of 1.
 */
class DarganTowerProvable extends ShuffleProvable
{
    /**
     * Min value. Default is 1.
     * @var int
     */
    private $min = 1;

    /**
     * Max value. Default is 4.
     * @var int
     */
    private $max = 4;

    /**
     * Number of cards to deal. Default is 3.
     * @var int
     */
    private $numOfCardsToDeal = 3;

    /**
     * Array length. Default is 9.
     * @var int
     */
    private $arrayLength = 9;

    /**
     * Constructs a DarganTowerProvable instance.
     * @param int|null $type The type of array to generate (optional)
     * @param string|null $clientSeed The client seed (optional)
     * @param string|null $serverSeed The server seed (optional)
     * 
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null, ?int $type= null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $type = $type ?? 1;
        $this->setMin($this->min);
        $this->setMax($type);
        $this->setNumOfCardsToDeal($type);
        $this->setArraylength($type);
    }
    
    /**
     * Set max.
     *
     * @param int|null $type The type of array to generate
     * @return ShuffleProvableInterface
     */
    public function setMax(?int $type = null): ShuffleProvableInterface
    {
        switch ($type) {
            case 1:
            case 5:
                $this->max = 4;
                break;
            case 2:
            case 4:
                $this->max = 3;
                break;
            case 3:
                $this->max = 2;
                break;
        }

        return $this;
    }

    /**
     * Get MAX.
     *
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * Set the number of cards to deal.
     *
     * @param int|null $type The type of array to generate
     * @return ShuffleProvableInterface
     */
    public function setNumOfCardsToDeal(?int $type = null): ShuffleProvableInterface
    {
        switch ($type) {
            case 1:
                $this->numOfCardsToDeal = 3;
                break;
            case 2:
                $this->numOfCardsToDeal = 2;
                break;
            default:
                $this->numOfCardsToDeal = 1;
        }

        return $this;
    }

    /**
     * Get the number of cards to deal.
     *
     * @return int
     */
    public function getNumOfCardsToDeal(): int
    {
        return $this->numOfCardsToDeal;
    }

    /**
     * Set the array length.
     *
     * @param int|null $type The type of array to generate
     * @return ShuffleProvableInterface
     */
    public function setArraylength(?int $type = 1): ShuffleProvableInterface
    {
        $this->arrayLength = ($type < 4) ? 9 : 6;
        return $this;
    }

    /**
     * Get the array length.
     *
     * @return int
     */
    public function getArraylength(): int
    {
        return $this->arrayLength;
    }

    /**
     * Shuffle the array of integers using HMAC-based shuffling algorithm.
     *
     * @return array The shuffled array
     */
    public function shuffle(): array
    {
        $resultArray = array();
        // Generate an array of integers from min to max
        $array = range($this->getMin(), $this->getMax());

        $shuffleTimes = $this->numOfCardsToDeal * $this->arrayLength;

        // Calculate the number of HMAC iterations
        $hmacNum = ceil($shuffleTimes / 8);
      
        $hmac = CommonUtils::generateHmac($this->getClientSeed(), $this->getServerSeed(), $hmacNum);

        for ($i = 0; $i < $this->arrayLength; $i++) {
            $shuffledArray = CommonUtils::fisherYatesShuffle($array, $hmac, $this->numOfCardsToDeal);
            array_push($resultArray, $shuffledArray);
            $hmac = substr($hmac, $this->numOfCardsToDeal * 8);
        }

        return $resultArray;
    }


}
