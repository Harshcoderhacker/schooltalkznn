<?php

namespace App\Providers;

use Config;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DynamicConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('fcmintegrations')) {
            $fcm = DB::table('fcmintegrations')->first();

            $fcm ? Config::set('larafirebase',
                ['authentication_key' => $fcm->serverkey]) : null;

        }
    }

/**
 * Bootstrap services.
 *
 * @return void
 */
    public function boot()
    {
        //
    }

}
