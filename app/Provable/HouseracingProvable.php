<?php

namespace App\Provable;


/**
 * Class HouseracingProvable
 * A class to shuffle an array of integers from 1 to 8.
 */
class HouseracingProvable extends ShuffleProvable
{


    /**
     * Min value. Default is 1.
     * @var int
     */
    private $min=1;

    /**
     * Max value. Default is 8.
     * @var int
     */
    private $max=8;
    
    /**
     * @param string|null $clientSeed The client seed 
     * @param string|null $serverSeed The server seed 
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setMin($this->min);
        $this->setMax($this->max);
        $this->setNumOfCardsToDeal();
    }


}
