<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    public function run()
    {
        $lang = [
            ['id' => 1, 'name' => 'English', 'is_default' => true],
            ['id' => 2, 'name' => 'Tamil'],
            ['id' => 3, 'name' => 'Hindi'],
            ['id' => 4, 'name' => 'Malayalam'],
        ];

        foreach ($lang as $row) {
            Language::create($row);
        }
    }
}
