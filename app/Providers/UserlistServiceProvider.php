<?php

namespace App\Providers;

use App\Repositories\UserlistRepository;
use App\Repositories\UserlistRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserlistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserlistRepositoryInterface::class, UserlistRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
