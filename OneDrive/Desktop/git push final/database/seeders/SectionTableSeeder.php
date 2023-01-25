<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'id' => 1,
            'name' => 'A',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 2,
            'name' => 'B',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 3,
            'name' => 'C',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 4,
            'name' => 'D',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 5,
            'name' => 'E',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 6,
            'name' => 'F',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 7,
            'name' => 'G',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Section::create([
            'id' => 8,
            'name' => 'H',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);
    }
}
