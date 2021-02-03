<?php

namespace App\Services\LastCommit;

use App\Services\LastCommit\Contracts\Platform;
use App\Services\LastCommit\Contracts\Service as Contract;
use App\Services\LastCommit\Platforms\Github\Platform as GithubPlatform;
use Illuminate\Support\Str;

class Service implements Contract
{
    /**
     * Get Github platform.
     *
     * @return \App\Services\LastCommit\Contracts\Platform
     */
    public function getGithubPlatform(): Platform
    {
        return app()->make(GithubPlatform::class);
    }

    /**
     * Get platform object by name.
     *
     * @param string $platform
     *
     * @return \App\Services\LastCommit\Contracts\Platform
     */
    public function getPlatform(string $platform): Platform
    {
        $platformMethodName = sprintf('get_%s_platform', $platform);
        $platformMethodName = Str::lower($platformMethodName);
        $platformMethodName = Str::camel($platformMethodName);

        if (! method_exists($this, $platformMethodName)) {
            throw new \InvalidArgumentException(
                sprintf('Passed service [%s] is not supported.', $platform)
            );
        }

        return app()->call([$this, $platformMethodName]);
    }
}
