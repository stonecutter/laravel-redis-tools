<?php

namespace stonecutter\LaravelRedisTools;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\Scan::class,
                Commands\ScanAndDelete::class,
            ]);
        }
    }
}
