<?php

namespace App\Providers;

use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\PostController;
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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */

    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // Route::middleware('web')
            //     ->namespace($this->namespace . '\FrontController') //使うコントローラーのパスを書く
            //     ->as('frontControllerName.')
            //     ->group(base_path('routes/frontRoute.php')); //実際のルート定義をどのファイルに書いているか

            // Route::middleware('web')
            //     ->get('/', $this->namespace . '\FrontController\PostController@index')->name('home');

            // Route::middleware('web')
            //     ->resource('posts', $this->namespace . '\FrontController\PostController')->only(['index', 'show']);

            Route::group(['namespace' => $this->namespace . '\FrontController'], function () { {
                    Route::get('/', 'PostController@index')->name('home');
                    Route::resource('posts', 'PostController')->only(['index', 'show']);
                }
            });


            Route::prefix('admin')
                ->middleware(['web', 'auth']) //追記
                ->namespace($this->namespace . '\Back')
                ->as('back.')
                ->group(base_path('routes/back.php'));






            Route::get('hello', function () {
                echo 'Hello';
            });

            Route::get('hello/create', function () {
                echo 'HelloCreate';
            });
            Route::get('hello/update', function () {
                echo 'HelloUpdate';
            });
            Route::get('hello/delete', function () {
                echo 'HelloDelete';
            });
        });
    }
    //prefixはURLの最初の文字列を一括で指定できる

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
