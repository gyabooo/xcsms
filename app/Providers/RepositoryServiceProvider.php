<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\CertificateDataAccess::class, function ($app) {
            return new \App\Repositories\CertificateRepository(
                new \App\Models\Commonname,
                new \App\Models\Certificate,
                new \App\Models\Virtualdomain,
                new \App\Models\CertificateService,
                new \App\Entities\CommonnameList
            );
        });

        $this->app->bind(\App\Services\VirtualdomainDataAccess::class, function ($app) {
            return new \App\Repositories\VirtualdomainRepository(
                new \App\Models\Virtualdomain,
                new \App\Entities\VirtualdomainList
            );
        });
    }
}
