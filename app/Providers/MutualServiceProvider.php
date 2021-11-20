<?php

namespace App\Providers;

use App\Repositories\MutualRepository;
use App\Repositories\MutualRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class MutualServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MutualRepositoryInterface::class, MutualRepository::class);

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
