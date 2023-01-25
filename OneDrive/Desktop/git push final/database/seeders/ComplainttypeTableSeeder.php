<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Frontdesksetting\Complainttype;
use Illuminate\Database\Seeder;

class ComplainttypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complainttype::create([
            'id' => 1,
            'name' => "Assualt",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Complainttype::create([
            'id' => 2,
            'name' => "Abuse",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Complainttype::create([
            'id' => 3,
            'name' => "Harassment",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Complainttype::create([
            'id' => 4,
            'name' => "Communication",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);
    }
}
