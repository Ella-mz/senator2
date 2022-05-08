<?php

namespace Modules\AssociationSkill\Providers;

use Illuminate\Support\ServiceProvider;

class AssociationSkillServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'AssociationSkills');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Attributes');

    }

    public function boot()
    {

    }
}
