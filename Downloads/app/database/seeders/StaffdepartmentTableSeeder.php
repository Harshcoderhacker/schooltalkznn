<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use Illuminate\Database\Seeder;

class StaffdepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staffdepartment::create([
            'id' => 1,
            'name' => 'Computer',
        ]);

        Staffdepartment::create([
            'id' => 2,
            'name' => 'Maths',
        ]);

        Staffdepartment::create([
            'id' => 3,
            'name' => 'Physics',
        ]);

        Staffdepartment::create([
            'id' => 4,
            'name' => 'PHP',
        ]);

        Staffdepartment::create([
            'id' => 5,
            'name' => 'C++',
        ]);
    }
}
