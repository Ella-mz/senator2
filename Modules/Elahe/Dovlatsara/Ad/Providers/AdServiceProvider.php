<?php


namespace Modules\Ad\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Ad\Http\Middleware\StoreAd;
use Modules\Ad\Http\Middleware\UsersAds;

class AdServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Ads');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(StoreAd::class);
        $router->aliasMiddleware('store.ad.auth',StoreAd::class);
        $kernel->pushMiddleware(UsersAds::class);
        $router->aliasMiddleware('user.ads',UsersAds::class);
    }
}
