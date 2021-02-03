<?php

namespace App\Services\LastCommit\Platforms\Github;

use App\Services\LastCommit\Contracts\Platform as Contract;
use App\Services\LastCommit\Contracts\Platform\Repository;
use GuzzleHttp\Client as HttpClient;

class Platform implements Contract
{
    /**
     * Github.com API base URL.
     *
     * @var string
     */
    protected $apiBaseUrl = 'https://api.github.com';

    /**
     * Find platform repository.
     *
     * @param string $name
     *
     * @return \App\Services\LastCommit\Contracts\Platform\Repository
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function findRepository(string $name): Repository
    {
        $this->validateRepositoryName($name);

        return app()->make(Platform\Repository::class, [
            'client' => app()->make(\App\Services\LastCommit\Contracts\Platform\Client::class, [
                'httpClient' => new HttpClient([
                    'base_uri' => sprintf('%s/repos/%s/', $this->apiBaseUrl, $name),
                    'verify'   => false, // locally i have problems with ssl certificate
                ]),
            ]),
            'name'   => $name,
        ]);
    }

    /**
     * Validate repository name with name pattern.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function validateRepositoryName(string $name): bool
    {
        if (! preg_match(Platform\Repository::NAME_PATTERN, $name)) {
            throw new \InvalidArgumentException(
                sprintf('Repository name [%s] for platform Github is invalid.', $name)
            );
        }

        return true;
    }
}
