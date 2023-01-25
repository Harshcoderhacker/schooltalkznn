<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Field;
use Illuminate\Database\Seeder;

class FieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'id' => 1,
            'name' => "Pongal",
            'field_type' => "Sports",
            'field_for' => "Student",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Field::create([
            'id' => 2,
            'name' => "Diwali",
            'field_type' => "Sports",
            'field_for' => "Student",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Field::create([
            'id' => 3,
            'name' => "Ramzan",
            'field_type' => "Sports",
            'field_for' => "Student",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Field::create([
            'id' => 4,
            'name' => "X-Mas",
            'field_type' => "Sports",
            'field_for' => "Student",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);

        Field::create([
            'id' => 5,
            'name' => "New Year",
            'field_type' => "Sports",
            'field_for' => "Student",
            'created_by' => 'Admin',
            'user_id' => 1,
            'active' => 1,
        ]);
    }
}
