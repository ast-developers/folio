<?php

namespace App\Providers;


use App\Interfaces\ProjectRepositoryInterface;
use App\Repositories\ProjectRepository;
use Illuminate\Support\ServiceProvider;

class ProjectRepositoryProvider extends ServiceProvider
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
        $this->app->bind(ProjectRepositoryInterface::class, function(){
            return new ProjectRepository();
        });


    }
}
