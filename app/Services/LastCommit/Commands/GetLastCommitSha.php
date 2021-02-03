<?php

namespace App\Services\LastCommit\Commands;

use App\Services\LastCommit\Contracts\Service;
use Illuminate\Console\Command;

class GetLastCommitSha extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get last commit SHA from repository on branch.';

    /**
     * Last commit service.
     *
     * @var \App\Services\LastCommit\Contracts\Service
     */
    protected $lastCommit;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'last-commit:sha {repository} {branch} {--service=github}';

    /**
     * GetLastCommit constructor.
     *
     * @param \App\Services\LastCommit\Contracts\Service $lastCommit
     */
    public function __construct(Service $lastCommit)
    {
        parent::__construct();
        $this->lastCommit = $lastCommit;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $platformName = $this->option('service');
        $repositoryName = $this->argument('repository');
        $branchName = $this->argument('branch');

        try {
            $platform = $this->lastCommit->getPlatform($platformName);
            $repository = $platform->findRepository($repositoryName);
            $commitSha = $repository->getLastCommitSha($branchName);

            $this->info(
                sprintf(
                    'Last commit SHA from repository [%s] on branch [%s] is [%s].',
                    $repositoryName, $branchName, $commitSha
                )
            );
        } catch (\GuzzleHttp\Exception\GuzzleException $exception) {
            // if http error occurred
            $this->error("Network error occurred.\n");
            $this->error($exception->getMessage());
        } catch (\Throwable $exception) {
            // if any error occurred
            // get message and display it
            $this->error($exception->getMessage());
        }
    }
}
