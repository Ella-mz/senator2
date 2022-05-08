<?php


namespace Modules\RoleAndPermission\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\RoleAndPermission\Http\Middleware\AccessLevelCheckMiddleware;

class RoleAndPermissionServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'RoleAndPermissions');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'RoleAndPermission');

    }
    public function boot( Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(AccessLevelCheckMiddleware::class);
        $router->aliasMiddleware('accesslevel',AccessLevelCheckMiddleware::class);
    }
}
