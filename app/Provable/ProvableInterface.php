<?php

declare(strict_types=1);

namespace App\Provable;

/**
 * Interface ProvableInterface.
 */
interface ProvableInterface
{
    /**
     * Get the client seed.
     *
     * @return string
     *   The current client seed.
     */
    public function getClientSeed(): string;
    
    /**
     * Get the hashed version of the server seed.
     *
     * @return string
     *   The hashed version of the current server seed.
     */
    public function getHashedServerSeed(): string;

    /**
     * Get the server seed.
     *
     * @return string
     *   The current server seed.
     */
    public function getServerSeed(): string;
    
    /**
     * Get new server seeds.
     * @return array
     */
    public function getNewServerSeeds(): array;
    
    /**
     * Get new server seed hashes.
     * @return array
     */
    public function getNewServerSeedHashes(): array;

    /**
     * Returns a random number of serverSeed and clientSeed.
     *
     * @return int
     *   The randomly generated number.
     */
    public function number(): int;


}
