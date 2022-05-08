<?php


namespace Modules\Comment\Providers;


use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Comments');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }

    public function boot()
    {

    }
}
