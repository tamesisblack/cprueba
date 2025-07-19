<?php

namespace sisVentas\Providers;

use Illuminate\Support\ServiceProvider;
use sisVentas\Http\Composers\OrdersComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'almacen.receptions.index', OrdersComposer::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this-> app->bind('path.public',function(){
            return base_path().'/sisVentas';
        });
    }
}
