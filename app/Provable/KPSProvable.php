<?php

namespace App\Provable;


/**
 * Class KPSProvable
 * This class generates a random number of 1-3 based on serverSeed and clientSeed.
 */
class KPSProvable extends  Provable
{
    
    /**
     * seed.
     * @var int
     */
    private $seed = 3;

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
