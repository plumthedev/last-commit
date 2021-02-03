<?php

namespace App\Services\LastCommit\Platforms\Github\Platform;

use App\Services\LastCommit\Foundation\Platform\AbstractRepository;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

class Repository extends AbstractRepository
{
    /**
     * Repository name pattern.
     */
    const NAME_PATTERN = '/^[a-zA-Z0-9(\.\-)]+\/[a-zA-Z0-9(\.\-)]+$/';

    /**
     * Get last commit SHA from passed branch.
     *
     * @param string $branch
     *
     * @return string
     */
    public function getLastCommitSha(string $branch): string
    {
        try {
            $commit = $this->client->get(sprintf('commits/%s', $branch));
        } catch (ClientException $exception) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Error occurred. Check branch name [%s] on [%s] repository and try again.',
                    $branch, $this->getName()
                )
            );
        }

        $sha = Arr::get($commit, 'sha');

        if (! $sha) {
            throw new \RuntimeException(
                sprintf(
                    'Last commit SHA not found for branch [%s] on repository [%s].',
                    $branch, $this->getName()
                )
            );
        }

        return $sha;
    }
}
