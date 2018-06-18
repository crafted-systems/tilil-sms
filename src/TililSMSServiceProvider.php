<?php

namespace CraftedSystems\Tilil;

use Illuminate\Support\ServiceProvider;

class TililSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/Config/tilil.php' => config_path('tilil.php'),
        ], 'tilil_config');

        $this->app->singleton(TililSMS::class, function () {
            return new TililSMS(config('tilil'));
        });

        $this->app->alias(TililSMS::class, 'tilil-sms');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/tilil.php', 'tilil-sms'
        );
    }
}
