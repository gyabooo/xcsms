<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AdminLteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        // $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
        //     // $event->menu->add('作業');
        //     $event->menu->add([
        //         'text' => 'コモンネーム',
        //         'url' => route('commonnames.index'),
        //     ]);
        //     $event->menu->add([
        //         'text' => 'バーチャルドメイン',
        //         'url' => route('commonnames.index'),
        //     ]);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
