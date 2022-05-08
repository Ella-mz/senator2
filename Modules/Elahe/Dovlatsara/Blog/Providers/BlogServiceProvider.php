<?php


namespace Modules\Blog\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Blog\Console\CreatePosition;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Blogs');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->commands([
            CreatePosition::class,
        ]);
    }

    public function boot()
    {

    }
}
