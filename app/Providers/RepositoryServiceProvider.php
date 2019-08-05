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
                new \App\Models\CommonName,
                new \App\Models\Certificate,
                new \App\Entities\CommonNameList
            );
        });
    }
}
