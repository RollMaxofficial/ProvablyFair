<?php

namespace App\Provable;


/**
 * Class RouletteProvable
 * This class generates a random number of 0-36 based on serverSeed and clientSeed.
 */
class RouletteProvable extends  Provable
{
    /**
     * seed.
     * @var int
     */
    private $seed = 37;
  
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
