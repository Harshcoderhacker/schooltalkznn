<?php

namespace App\Providers;

use App\Models\Admin\Settings\Schoolsetting\Generalsetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('generalsetting', function () {
            return Generalsetting::first();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Model::preventLazyLoading(!$this->app->isProduction());
    }
}
