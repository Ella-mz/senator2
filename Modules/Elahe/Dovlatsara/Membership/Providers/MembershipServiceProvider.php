<?php


namespace Modules\Membership\Providers;


use Illuminate\Support\ServiceProvider;

class MembershipServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Memberships');

    }

    public function boot()
    {

    }
}
