<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\EnumType\Repositories\EnumTypeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->shareView();
//        Auth::loginUsingId(2);
    }
    public function shareView()
    {
        $enumTypeRepository = new EnumTypeRepository;
        $this->enumTypeRepository = $enumTypeRepository;

        View::share([
            'widgets' => $this->enumTypeRepository->findEnumTypesByEnumTitle('widget'),
        ]);

    }
}
