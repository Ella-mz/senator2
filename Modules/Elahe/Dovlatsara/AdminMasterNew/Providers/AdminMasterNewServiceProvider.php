<?php


namespace Modules\AdminMasterNew\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\AdminMaster\Http\Middleware\AdminAuth;

class AdminMasterNewServiceProvider extends ServiceProvider
{
    /**
     * Register users Providers.
     *
     * @return void
     */
    public function register()
    {
//        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'AdminMasterNew');
    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(AdminAuth::class);
        $router->aliasMiddleware('admin.auth',AdminAuth::class);
    }
}
