<?php

namespace App\Providers;

use App\Models\XmlProcess;
use App\Observers\XmlProcessObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\TypeRepositoryInterface',
            'App\Repositories\Eloquent\TypeRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ProductRepositoryInterface',
            'App\Repositories\Eloquent\ProductRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
