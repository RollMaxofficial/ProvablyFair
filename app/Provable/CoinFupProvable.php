<?php

namespace App\Provable;


/**
 * Class CoinFupProvable
 * This class generates a random number of 1-2 based on serverSeed and clientSeed.
 */
class CoinFupProvable  extends  Provable
{
  
     /**
     * seed.
     * @var int
     */
    private $seed = 2;

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
