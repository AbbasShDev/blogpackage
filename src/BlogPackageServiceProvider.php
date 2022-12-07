<?php

namespace AbbasShDev\BlogPackage;

use AbbasShDev\BlogPackage\Console\InstallBlogPackage;
use AbbasShDev\BlogPackage\Http\Middleware\CapitalizeTitle;
use AbbasShDev\BlogPackage\Providers\EventServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use AbbasShDev\BlogPackage\View\Components\Alert;

class BlogPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('calculator', function($app) {
            return new Calculator();
        });

        $this->app->register(EventServiceProvider::class);

        $this->mergeConfigFrom(__DIR__.'/../config/blogpackage.php', 'blogpackage');
    }

    public function boot(Kernel $kernel)
    {
        if($this->app->runningInConsole()){
            $this->commands([
                InstallBlogPackage::class
            ]);

            $this->publishes(
                [
                    __DIR__.'/../config/blogpackage.php' => config_path('blogpackage.php')
                ],
                'config'
            );

            $this->publishes(
                [
                    __DIR__ . '/../database/migrations/create_posts_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_posts_table.php')
                ],
                'migrations'
            );

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/blogpackage'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../src/View/Components/' => app_path('View/Components'),
                __DIR__.'/../resources/views/components/' => resource_path('views/components'),
            ], 'view-components');

            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('blogpackage'),
            ], 'assets');
        }

        $this->registerRoutes();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blogpackage');

        $this->loadViewComponentsAs('blogpackage', [
            Alert::class,
        ]);

//        $kernel->pushMiddleware(CapitalizeTitle::class);
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('capitalize', CapitalizeTitle::class);
//        $router->pushMiddlewareToGroup('web', CapitalizeTitle::class);

    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function (){
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix' => config('blogpackage.prefix'),
            'middleware' => config('blogpackage.middleware'),
        ];
    }
}