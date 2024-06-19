<?php

namespace App\Provable;


/**
 * Class MinesProvable
 * A class to shuffle an array of integers from 1 to 25 .
 */
class MinesProvable extends ShuffleProvable
{


    /**
     * Min value. Default is 0.
     * @var int
     */
    private $min=1;

    /**
     * Max value. Default is 24.
     * @var int
     */
    private $max=25;
    
    /**
     * @param string|null $clientSeed The client seed (optional)
     * @param string|null $serverSeed The server seed (optional)
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setMin( $this->min);
        $this->setMax( $this->max);
        $this->setNumOfCardsToDeal();
    }

    /**
     * Generate the result array.
     *
     * @return array The result array with x and y coordinates
     */
    public function results(): array
    {
        try {
            $array = $this->shuffle();
            return $array;
            // return $this->prepareResultArray($array);
        } catch (\Exception $e) {
            // If any exception occurs, return null
            return [];
        }   
    }

    /**
     * Prepare the result array with x and y coordinates.
     *
     * @param array $array The array to be processed
     * @return array The result array with x and y coordinates
     */
    private function prepareResultArray(array $array): array
    {
        // Prepare result array with x and y coordinates
        $result = [];
        foreach ($array as $value) {
            $x = ($value % 5) + 1;
            $y = 5 - floor($value / 5);
             //$result[] = ['x' => $x, 'y' => $y];
             $result[] = (5-$y)*5+$x;
        }

        return $result;
    }


}
