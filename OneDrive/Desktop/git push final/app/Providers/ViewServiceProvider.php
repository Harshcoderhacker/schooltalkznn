<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\Http\View\Composers\AdminComposer');
        View::composer('*', 'App\Http\View\Composers\ParentComposer');
        View::composer('*', 'App\Http\View\Composers\StaffComposer');

        View::composer('*', 'App\Http\View\Composers\FakerComposer');
        View::composer('*', 'App\Http\View\Composers\DarkModeComposer');
        View::composer('*', 'App\Http\View\Composers\LoggedInUserComposer');
        View::composer('*', 'App\Http\View\Composers\ColorSchemeComposer');
    }
}
