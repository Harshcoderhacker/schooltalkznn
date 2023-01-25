<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Settings\Schoolsetting\Academicyearmonthlist;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AcademicyearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicyear = Academicyear::create([
            'year' => 2022,
            'title' => "Even Year",
            'start_date' => "2022-01-20",
            'end_date' => "2023-02-21",
        ]);

        $period = CarbonPeriod::create($academicyear->start_date, '1 month', $academicyear->end_date);

        foreach ($period as $dt) {
            Academicyearmonthlist::create([
                'academicyear_id' => $academicyear->id,
                'monthdate' => $dt->format("Y-m-d"),
                'month' => $dt->format("m"),
                'year' => $dt->format("Y"),
                'month_string' => $dt->format("F Y"),
            ]);
        }

        $academicyear = Academicyear::create([
            'year' => 2023,
            'title' => "Even Year",
            'start_date' => "2023-01-20",
            'end_date' => "2024-01-21",
        ]);

        $period = CarbonPeriod::create($academicyear->start_date, '1 month', $academicyear->end_date);

        foreach ($period as $dt) {
            Academicyearmonthlist::create([
                'academicyear_id' => $academicyear->id,
                'monthdate' => $dt->format("Y-m-d"),
                'month' => $dt->format("m"),
                'year' => $dt->format("Y"),
                'month_string' => $dt->format("F Y"),
            ]);
        }

        $academicyear = Academicyear::create([
            'year' => 2024,
            'title' => "Even Year",
            'start_date' => "2024-01-20",
            'end_date' => "2025-01-21",
        ]);

        $period = CarbonPeriod::create($academicyear->start_date, '1 month', $academicyear->end_date);

        foreach ($period as $dt) {
            Academicyearmonthlist::create([
                'academicyear_id' => $academicyear->id,
                'monthdate' => $dt->format("Y-m-d"),
                'month' => $dt->format("m"),
                'year' => $dt->format("Y"),
                'month_string' => $dt->format("F Y"),
            ]);
        }

        $academicyear = Academicyear::create([
            'year' => 2025,
            'title' => "Even Year",
            'start_date' => "2025-01-20",
            'end_date' => "2026-01-21",
        ]);

        $period = CarbonPeriod::create($academicyear->start_date, '1 month', $academicyear->end_date);

        foreach ($period as $dt) {
            Academicyearmonthlist::create([
                'academicyear_id' => $academicyear->id,
                'monthdate' => $dt->format("Y-m-d"),
                'month' => $dt->format("m"),
                'year' => $dt->format("Y"),
                'month_string' => $dt->format("F Y"),
            ]);
        }

        $academicyear = Academicyear::create([
            'year' => 2027,
            'title' => "Even Year",
            'start_date' => "2027-01-20",
            'end_date' => "2026-01-21",
        ]);

        $period = CarbonPeriod::create($academicyear->start_date, '1 month', $academicyear->end_date);

        foreach ($period as $dt) {
            Academicyearmonthlist::create([
                'academicyear_id' => $academicyear->id,
                'monthdate' => $dt->format("Y-m-d"),
                'month' => $dt->format("m"),
                'year' => $dt->format("Y"),
                'month_string' => $dt->format("F Y"),
            ]);
        }

    }
}
