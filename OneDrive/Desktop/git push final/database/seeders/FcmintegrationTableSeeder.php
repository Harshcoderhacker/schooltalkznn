<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Integration\Fcmintegration;
use Illuminate\Database\Seeder;

class FcmintegrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fcmintegration::create([
            "email" => "xxxx@gmail.com",
            "serverkey" => "xxxxxxxxxxxx",
            "is_default" => true,
        ]);
    }
}
