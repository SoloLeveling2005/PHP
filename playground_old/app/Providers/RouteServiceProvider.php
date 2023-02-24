<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {

        $this->restApi();
        $this->adminPanel();

    //        $this->routes(function () {
    //            Route::middleware('api')
    //                ->prefix('api')
    //                ->group(base_path('routes/api.php'));
    //
    //            Route::middleware('web')
    //                ->group(base_path('routes/web.php'));
    //
    //
    //        });
    }

    protected function restApi()
    {
        Route::prefix('api')->middleware('api')->group(function () {
            Route::middleware('api')->namespace($this->namespace)->group(base_path('routes/api.php'));
        });
    }

    // todo login to the portal, ulr:       /XX-module-a/admin
    // todo check user, url:                /XX-module-a/user/:username
    // todo check game, url:                /XX-module-a/game/:slug         slug = game id

    protected function adminPanel()
    {
        Route::prefix('XX-module-a')->group(base_path('routes/admin.php'));
    }
}
