<?php


namespace Modules\UserMaster\Providers;


use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\UserMaster\Http\Middleware\UserAuth;

class UserMasterServiceProvider extends ServiceProvider
{
    /**
     * Register users Providers.
     *
     * @return void
     */
    public function register()
    {
//        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
//        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'UserMaster');
    }

    public function boot(Router $router, Kernel $kernel)
    {
//        $this->registerTranslations();
//        $this->registerConfig();
////        $this->registerViews();
//        $this->loadMigrationsFrom(module_path('UserMaster', 'Database/Migrations'));
//        $kernel->pushMiddleware(UserAuth::class);
//        $router->aliasMiddleware('user.auth',UserAuth::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
//        $this->publishes([
//            module_path('UserMaster', 'Config/config.php') => config_path('usermaster' . '.php'),
//        ], 'config');
//        $this->mergeConfigFrom(
//            module_path('UserMaster', 'Config/config.php'), 'usermaster'
//        );
    }

}
