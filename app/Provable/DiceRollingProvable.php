<?php

namespace App\Provable;


/**
 * Class DiceRollingProvable
 * This class generates a random number of 1-6 based on serverSeed and clientSeed.
 */
class DiceRollingProvable  extends  Provable
{
    
    /**
     * seed.
     * @var int
     */
    private $seed = 6;

    /**
     * start.
     * @var int
     */
    private $start = 1;

  
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
