<?php

namespace App\Provable;

/**
 * Class NormalProvable
 * This class generates a random number between x and y, inclusive of y based on serverSeed and clientSeed.
 */
class NormalProvable extends  Provable
{
    /**
     * The seed value.
     * @var int
     */
    private $seed;

    /**
     * The start value.
     * @var int
     */
    private $start;

    /**
     * Class constructor.
     * @param string|null $clientSeed The client seed (optional)
     * @param string|null $serverSeed The server seed (optional)
     * @param int|null $min The minimum value (optional)
     * @param int|null $max The maximum value (optional)
     */
    public function __construct(?string $clientSeed = null, ?string $serverSeed = null,?int $min = null, ?int $max = null )
    {
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
        $this->setSeed($max);
        $this->setStart($min);
    }

    /**
     * Static constructor.
     * @param string|null $clientSeed
     * @param string|null $serverSeed
     * @param int|null $min The minimum value (optional)
     * @param int|null $max The maximum value (optional)
     * @return \App\LimboProvable\ProvableInterface
     */
    public static function init(?string $clientSeed = null, ?string $serverSeed = null, ?int $min = null, ?int $max = null): ProvableInterface
    {
        return new static($clientSeed, $serverSeed,$min,$max );
    }

    /**
     * Setter for the seed value.
     *
     * @param int|null $max The maximum value (optional)
     * @return ProvableInterface
     */
    public function setSeed(?int $max = null): ProvableInterface
    {
        $this->seed = $max??9;
        $this->seed++;
        return $this;
    }

    /**
     * Getter for the seed value.
     *
     * @return int
     */
    public function getSeed(): int
    {
        return $this->seed;
    }

    
}
