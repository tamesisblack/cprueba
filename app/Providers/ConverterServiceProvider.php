<?php

namespace sisVentas\Providers;

use Illuminate\Support\ServiceProvider;

class ConverterServiceProvider extends ServiceProvider
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
        require_once app_path() . '/Helpers/NumerosEnLetras.php';
    }
}
