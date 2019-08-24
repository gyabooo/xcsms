<?php

namespace App\Providers;

use App\Services\VirtualdomainService;
use Illuminate\Support\ServiceProvider;

class VirtualdomainServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('VirtualdomainService', VirtualdomainService::class);
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
