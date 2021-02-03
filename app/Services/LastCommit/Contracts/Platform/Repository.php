<?php

namespace App\Services\LastCommit\Contracts\Platform;

interface Repository
{
    /**
     * Get last commit SHA from passed branch.
     *
     * @param string $branch
     *
     * @return string
     */
    public function getLastCommitSha(string $branch): string;
}
