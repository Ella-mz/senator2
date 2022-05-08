<?php

namespace Modules\HologramInterface\Providers;

use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\HologramInterface\Http\Middleware\RequestIsPending;

class HologramInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register Attributes Providers.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'HologramInterfaces');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(RequestIsPending::class);
        $router->aliasMiddleware('request.pending',RequestIsPending::class);
    }
}
