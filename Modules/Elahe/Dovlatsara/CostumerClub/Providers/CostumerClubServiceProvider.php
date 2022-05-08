<?php
namespace Modules\CostumerClub\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CostumerClub\Console\ScoreRecords;

class CostumerClubServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'CostumerClubs');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->commands([
            ScoreRecords::class,
        ]);
    }

    public function boot()
    {

    }
}
