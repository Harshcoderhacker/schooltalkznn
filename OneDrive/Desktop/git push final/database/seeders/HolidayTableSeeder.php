<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Holiday;
use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::create([
            'id' => 1,
            'name' => "Pongal",
            'start_date' => "2021-11-20 00:00:00",
            'end_date' => "2021-11-21 00:00:00",
        ]);

        Holiday::create([
            'id' => 2,
            'name' => "Diwali",
            'start_date' => "2021-11-20 00:00:00",
            'end_date' => "2021-11-21 00:00:00",
        ]);

        Holiday::create([
            'id' => 3,
            'name' => "Ramzan",
            'start_date' => "2021-11-20 00:00:00",
            'end_date' => "2021-11-21 00:00:00",
        ]);

        Holiday::create([
            'id' => 4,
            'name' => "X-Mas",
            'start_date' => "2021-11-20 00:00:00",
            'end_date' => "2021-11-21 00:00:00",
        ]);

        Holiday::create([
            'id' => 5,
            'name' => "New Year",
            'start_date' => "2021-11-20 00:00:00",
            'end_date' => "2021-11-21 00:00:00",
        ]);
    }
}
