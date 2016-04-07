<?php

namespace App\Providers;

use App\Interfaces\EmailServiceInterface;
use App\Repositories\EmailServiceRepository;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
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
        $this->app->bind(EmailServiceInterface::class, function(){
            return new EmailServiceRepository();
        });


    }
}
