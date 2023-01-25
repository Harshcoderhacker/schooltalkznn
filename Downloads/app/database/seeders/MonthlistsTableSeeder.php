<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Monthlist;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MonthlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Monthlist::create([
            'monthdate' => Carbon::parse('01-01-2022'),
            'month' => 1,
            'year' => 2022,
            'month_string' => Carbon::parse('01-01-2022')->format('M-Y'),
            'is_currentmonth' => 0,
            'is_futuremonth' => 0,
            'is_pastmonth' => 1,
        ]);

        Monthlist::create([
            'monthdate' => Carbon::parse('01-02-2022'),
            'month' => 2,
            'year' => 2022,
            'month_string' => Carbon::parse('01-02-2022')->format('M-Y'),
            'is_currentmonth' => 1,
            'is_futuremonth' => 0,
            'is_pastmonth' => 0,
        ]);

        Monthlist::create([
            'monthdate' => Carbon::parse('01-03-2022'),
            'month' => 3,
            'year' => 2022,
            'month_string' => Carbon::parse('01-03-2022')->format('M-Y'),
            'is_currentmonth' => 0,
            'is_futuremonth' => 1,
            'is_pastmonth' => 0,
        ]);

        Monthlist::create([
            'monthdate' => Carbon::parse('01-04-2022'),
            'month' => 4,
            'year' => 2022,
            'month_string' => Carbon::parse('01-04-2022')->format('M-Y'),
            'is_currentmonth' => 0,
            'is_futuremonth' => 1,
            'is_pastmonth' => 0,
        ]);

        Monthlist::create([
            'monthdate' => Carbon::parse('01-05-2022'),
            'month' => 5,
            'year' => 2022,
            'month_string' => Carbon::parse('01-05-2022')->format('M-Y'),
            'is_currentmonth' => 0,
            'is_futuremonth' => 1,
            'is_pastmonth' => 0,
        ]);
    }

}
