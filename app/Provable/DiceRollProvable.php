<?php

namespace App\Provable;


/**
 * Class DiceRollProvable
 * This class generates a random number of 0-10000 based on serverSeed and clientSeed.
 */
class DiceRollProvable extends  Provable
{
    
    /**
     * seed.
     * @var int
     */
    private $seed = 10001;

    /**
     * start.
     * @var int
     */
    private $start = 0;
  
     /**
     * Class constructor.
     * @param string|null $clientSeed
     * @param string|null $serverSeed
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setSeed($this->seed);
        $this->setStart($this->start);
    }


}
