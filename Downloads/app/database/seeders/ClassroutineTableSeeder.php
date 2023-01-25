<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use Illuminate\Database\Seeder;

class ClassroutineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([[
            'name' => 'Period 1',
            'start_time' => "09:00:00",
            'end_time' => "09:40:00",
        ], [
            'name' => 'Period 2',
            'start_time' => "09:40:00",
            'end_time' => "10:15:00",
        ], [
            'name' => 'Period 3',
            'start_time' => "10:30:00",
            'end_time' => "11:10:00",
        ], [
            'name' => 'Morning Break',
            'start_time' => "11:10:00",
            'end_time' => "11:20:00",
            'is_break' => true,
        ],
        ])
            ->each(fn($classroutine) =>
                Classroutine::create($classroutine));
    }
}
