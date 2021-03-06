<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Configuration\DotEnvConfiguration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConfigurationInterface::class, function(){
            return new DotEnvConfiguration(base_path());
        });
    }
}
