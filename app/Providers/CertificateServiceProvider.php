<?php

namespace App\Providers;

use App\Services\CertificateService;
// use App\Services\CertificateDataAccess;
use Illuminate\Support\ServiceProvider;

class CertificateServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('CertificateService', CertificateService::class);
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
