<?php

namespace Sinclair\Settingable;

use Illuminate\Support\ServiceProvider;
use Sinclair\ApiFoundation\Providers\ApiFoundationServiceProvider;
use Sinclair\PaymentEngine\Commands\GenerateTransaction;
use Sinclair\PaymentEngine\Commands\ProcessTransaction;
use Wtbi\Schedulable\Providers\SchedulableServiceProvider;

class SettingableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../migrations' => base_path('/database/migrations'),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Sinclair\Settingable\Contracts\Setting', 'Sinclair\Settingable\Setting');
        $this->app->bind('Setting', 'Sinclair\Settingable\Contracts\Setting');

        $this->app->bind('Sinclair\Settingable\Contracts\Settingable', 'Sinclair\Settingable\Settingable');
        $this->app->bind('Settingable', 'Sinclair\Settingable\Contracts\Settingable');
    }
}