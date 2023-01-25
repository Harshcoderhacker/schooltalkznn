<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use Illuminate\Database\Seeder;

class StaffdesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staffdesignation::create([
            'id' => 1,
            'name' => 'Teaching',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Staffdesignation::create([
            'id' => 2,
            'name' => 'Non Teaching',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Staffdesignation::create([
            'id' => 3,
            'name' => 'Cleaning',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);
    }
}
