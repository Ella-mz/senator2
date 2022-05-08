<?php

namespace Modules\RealestateMaster\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Kernel;
use Illuminate\Routing\Router;
use Modules\RealestateMaster\Http\Middleware\RealestateAuth;

class RealestateMasterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'RealestateMaster');

    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(RealestateAuth::class);
        $router->aliasMiddleware('realestate.auth',RealestateAuth::class);
    }
}
