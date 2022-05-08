<?php


namespace Modules\UserMasterNew\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\UserMaster\Http\Middleware\UserAuth;

class UserMasterNewServiceProvider extends ServiceProvider
{
    /**
     * Register users Providers.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'UserMasterNew');
    }

    public function boot(Router $router, Kernel $kernel)
    {
        $kernel->pushMiddleware(UserAuth::class);
        $router->aliasMiddleware('user.auth',UserAuth::class);
    }
}
