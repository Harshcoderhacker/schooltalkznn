<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Weekend;
use Illuminate\Database\Seeder;

class WeekendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Weekend::create([
            'id' => 1,
            'name' => 'Monday',
            'shortname' => 'Mon',
            'dayvalue' => 1,
        ]);

        Weekend::create([
            'id' => 2,
            'name' => 'Tuesday',
            'shortname' => 'Tue',
            'dayvalue' => 2,
        ]);

        Weekend::create([
            'id' => 3,
            'name' => 'Wednesday',
            'shortname' => 'Wed',
            'dayvalue' => 3,
        ]);

        Weekend::create([
            'id' => 4,
            'name' => 'Thursday',
            'shortname' => 'Thu',
            'dayvalue' => 4,
        ]);

        Weekend::create([
            'id' => 5,
            'name' => 'Friday',
            'shortname' => 'Fri',
            'dayvalue' => 5,
        ]);

        Weekend::create([
            'id' => 6,
            'name' => 'Saturday',
            'is_holiday' => true,
            'shortname' => 'Sat',
            'dayvalue' => 6,

        ]);

        Weekend::create([
            'id' => 7,
            'name' => 'Sunday',
            'is_holiday' => true,
            'shortname' => 'Sun',
            'dayvalue' => 7,
        ]);
    }
}
