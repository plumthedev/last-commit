<?php

namespace App\Providers;

use App\Services\LastCommit\Contracts\Platform\Client as PlatformClientContract;
use App\Services\LastCommit\Contracts\Service as ServiceContract;
use App\Services\LastCommit\Foundation\Platform\Client as PlatformClient;
use App\Services\LastCommit\Service as Service;
use Illuminate\Support\ServiceProvider;

class LastCommitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->alias(Service::class, ServiceContract::class);
        $this->app->alias(PlatformClient::class, PlatformClientContract::class);

        $this->app->bind(ServiceContract::class, Service::class);
        $this->app->bind(PlatformClientContract::class, PlatformClient::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
