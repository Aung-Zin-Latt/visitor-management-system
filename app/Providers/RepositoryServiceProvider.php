<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Bind the contracts and repositories
        $this->app->bind(
            'App\Contracts\VisitorInterface',
            'App\Repositories\VisitorRepository'
        );
        $this->app->bind(
            'App\Contracts\CheckinInterface',
            'App\Repositories\CheckinRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
