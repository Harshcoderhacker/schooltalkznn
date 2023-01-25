<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Subject::create([
            'id' => 1,
            'name' => 'Computer Science',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 2,
            'name' => 'Maths',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 3,
            'name' => 'Physics',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 4,
            'name' => 'Chemistry',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 5,
            'name' => 'English',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 6,
            'name' => 'Tamil',

            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 7,
            'name' => 'Biology',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Subject::create([
            'id' => 8,
            'name' => 'Social Science',
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

    }
}
