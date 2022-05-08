<?php


namespace Modules\Advertising\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Advertising\Http\Middleware\AdvertisingDuplicateCheck;

class AdvertisingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Advertisings');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(AdvertisingDuplicateCheck::class);
        $router->aliasMiddleware('AdvertisingDuplicateCheck',AdvertisingDuplicateCheck::class);
    }
}
