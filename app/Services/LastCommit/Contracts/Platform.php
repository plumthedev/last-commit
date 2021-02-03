<?php

namespace App\Services\LastCommit\Contracts;

use App\Services\LastCommit\Contracts\Platform\Repository;

interface Platform
{
    /**
     * Find platform repository.
     *
     * @param string $name
     *
     * @return \App\Services\LastCommit\Contracts\Platform\Repository
     */
    public function findRepository(string $name): Repository;
}
