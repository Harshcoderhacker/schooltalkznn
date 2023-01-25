<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Classtype;
use Illuminate\Database\Seeder;

class ClasstypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Primary'],
            ['name' => 'Secondary'],
            ['name' => 'Higher Secondary'],
        ];

        foreach ($data as $eachdata) {
            Classtype::create($eachdata);
        }
    }
}
