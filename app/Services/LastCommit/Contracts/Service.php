<?php

namespace App\Services\LastCommit\Contracts;

interface Service
{
    /**
     * Get GitHub platform.
     *
     * @return \App\Services\LastCommit\Contracts\Platform
     */
    public function getGithubPlatform(): Platform;

    /**
     * Get platform object by name.
     *
     * @param string $platform
     *
     * @return \App\Services\LastCommit\Contracts\Platform
     */
    public function getPlatform(string $platform): Platform;
}
