<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Leavesetting\Leavetype;
use Illuminate\Database\Seeder;

class LeavetypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Leavetype::create([
            'id' => 1,
            'name' => "Earned Leave",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Leavetype::create([
            'id' => 2,
            'name' => "Casual Leave",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Leavetype::create([
            'id' => 3,
            'name' => "Sick Leave",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Leavetype::create([
            'id' => 4,
            'name' => "Maternity Leave",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Leavetype::create([
            'id' => 5,
            'name' => "Half Pay Leave",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);
    }
}
