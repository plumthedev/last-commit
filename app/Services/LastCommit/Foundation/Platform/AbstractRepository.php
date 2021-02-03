<?php

namespace App\Services\LastCommit\Foundation\Platform;

use App\Services\LastCommit\Contracts\Platform\Client;
use App\Services\LastCommit\Contracts\Platform\Repository as Contract;

abstract class AbstractRepository implements Contract
{
    /**
     * Platform client.
     *
     * @var \App\Services\LastCommit\Contracts\Platform\Client
     */
    protected $client;

    /**
     * Platform repository name.
     *
     * @var string
     */
    protected $name;

    /**
     * Repository constructor.
     *
     * @param \App\Services\LastCommit\Contracts\Platform\Client $client
     * @param string                                             $name
     */
    public function __construct(Client $client, string $name)
    {
        $this->client = $client;
        $this->name = $name;
    }

    /**
     * Get repository name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
