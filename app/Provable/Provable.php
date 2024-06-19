<?php

namespace App\Provable;


/**
 * Class Provable
 * This class generates a random number of 0-1 based on serverSeed and clientSeed.
 */
class Provable implements ProvableInterface
{
    
    
    /**
     * Client seed.
     * @var string
     */
    private $clientSeed;

    /**
     * Server seed.
     * @var string
     */
    private $serverSeed;

    /**
     * seed length.
     * @var int
     */
    private $clientSeedLength=32;

    /**
     * seed.
     * @var int
     */
    private $seed = 2;

     /**
     * start.
     * @var int
     */
    private $start = 0;

    /**
     * New server seeds.
     * @var array
     */
    private $newServerSeeds = [];

    /**
     * New server seed hashes.
     * @var array
     */
    private $newServerSeedHashes = [];


    /**
     * Class constructor.
     * @param int|null $seedLength
     * @param string|null $clientSeed
     * @param string|null $serverSeed
     */
    public function __construct(?int $clientSeedLength = null,?string $clientSeed = null, ?string $serverSeed = null)
    {
        $this->setClientSeedLength($clientSeedLength);
        $this->setClientSeed($clientSeed);
        $this->setServerSeed($serverSeed);
       
        $this->generateNewServerSeeds();
    }
    
    /**
     * Static constructor.
     * @param string|null $clientSeed
     * @param string|null $serverSeed
     * @return \App\LimboProvable\ProvableInterface
     */
    public static function init(?string $clientSeed = null, ?string $serverSeed = null, ?int $min = null, ?int $max = null): ProvableInterface
    {
        return new static($clientSeed, $serverSeed );
    }

    /**
     * Generate and set new server seeds and their hashes.
     * @return \App\Provable\ProvableInterface
     */
    public function generateNewServerSeeds(): ProvableInterface
    {
        $this->newServerSeeds = [];
        $this->newServerSeedHashes = [];

        for ($i = 0; $i < 5; $i++) {
            $newSeed = $this->generateRandomSeed();
            $this->newServerSeeds[] = $newSeed;
            $this->newServerSeedHashes[] = hash('sha256', $newSeed);
        }
        return $this;
    }

    /**
     * Client seed setter.
     * @param string|null $clientSeed
     * @return \App\Provable\ProvableInterface
     */
    public function setClientSeed(?string $clientSeed = null): ProvableInterface
    {
        $this->clientSeed = $clientSeed ?? $this->generateRandomSeed($this->getClientSeedLength());
        return $this;
    }

    /**
     * Client seed getter.
     * @return string
     */
    public function getClientSeed(): string
    {
        return $this->clientSeed;
    }

    /**
     * Server seed setter.
     * @param string|null $serverSeed
     * @return \App\Provable\ProvableInterface
     */
    public function setServerSeed(?string $serverSeed = null): ProvableInterface
    {
        $this->serverSeed = $serverSeed ?? $this->generateRandomSeed();
        return $this;
    }

    /**
     * Server seed getter.
     * @return string
     */
    public function getServerSeed(): string
    {
        return $this->serverSeed;
    }

    /**
     * Get new server seeds.
     * @return array
     */
    public function getNewServerSeeds(): array
    {
        return $this->newServerSeeds;
    }

    /**
     * Get new server seed hashes.
     * @return array
     */
    public function getNewServerSeedHashes(): array
    {
        return $this->newServerSeedHashes;
    }

    /**
     * Generate a random seed.
     * @return string
     */
    private function generateRandomSeed(?int $clientSeedLength = null): string
    {
        return bin2hex(openssl_random_pseudo_bytes($clientSeedLength??32));
    }

    /**
     * Hashed server seed getter.
     * @return string
     */
    public function getHashedServerSeed(): string
    {
        return hash('sha256', $this->serverSeed);
    }

    /**
     * seedLength setter.
     * @param int|null $seedLength
     * @return \App\Provable\ProvableInterface
     */
    public function setClientSeedLength(?int $clientSeedLength = null): ProvableInterface
    {
        $this->clientSeedLength = $clientSeedLength??32;
        return $this;
    }

    /**
     * seedLength getter.
     * @return int
     */
    public function getClientSeedLength(): int
    {
        return $this->clientSeedLength;
    }

    /**
     * seed setter.
     * @param int|null $seed
     * @return \App\Provable\ProvableInterface
     */
    public function setSeed(?int $seed = null): ProvableInterface
    {
        $this->seed = $seed??2;
        return $this;
    }

    /**
     * seed getter.
     * @return int
     */
    public function getSeed(): int
    {
        return $this->seed;
    }

    /**
     * start setter.
     * @param int|null $start
     * @return \App\Provable\ProvableInterface
     */
    public function setStart(?int $start = null): ProvableInterface
    {
        $this->start = $start??0;
        return $this;
    }

    /**
     * start getter.
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * Returns a random number within a range.
     * @return int
     */
    public function number(): int
    {
        return $this->generateRandomInteger();
    }

    /**
     * Generate a random integer from the server seed and client seed.
     *
     * @return int The generated random integer
     */
    private function generateRandomInteger(): int
    {
        // Generate HMAC using server seed and client seed
        $hmac = hash_hmac('sha256', $this->getClientSeed() ,$this->getServerSeed());
       
        // Geneerate random number
        $random = CommonUtils::generateRandomNumbers($hmac, $this->getSeed());
        // Convert the range from 0-send to start-(start+send)
        return $random +  $this->getStart(); 
    }


}
