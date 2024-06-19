<?php

namespace App\Provable;


/**
 * Class KenoProvable
 * A class to shuffle an array of integers from 1 to 80 and return 20 elements.
 */
class KenoProvable extends ShuffleProvable
{


     /**
     * Min value. Default is 1.
     * @var int
     */
    private $min=1;

    /**
     * Max value. Default is 80.
     * @var int
     */
    private $max=80;
    
    /**
     * Number of cards to deal. Default is 20.
     * @var int
     */
    private $numOfCardsToDeal=20;

    /**
     * @param string|null $clientSeed The client seed (optional)
     * @param string|null $serverSeed The server seed (optional)
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setMin($this->min);
        $this->setMax($this->max);
        $this->setNumOfCardsToDeal($this->numOfCardsToDeal);
    }



}
