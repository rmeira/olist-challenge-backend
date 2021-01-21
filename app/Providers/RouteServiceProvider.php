<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers\\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(1));

        $this->routes(function () {
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        });
    }
}
