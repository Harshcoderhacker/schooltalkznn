<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use Illuminate\Database\Seeder;

class MapclassTableSeeder extends Seeder
{
    public function run()
    {
        $classmaster = Classmaster::where('active', true)->get();
        foreach ($classmaster as $key => $value) {
            Mapclass::create([
                'id' => $key + 1,
                'classmaster_id' => $value->id,
                'created_by' => 'Admin',
                'user_id' => 1,
                'active' => 1,
            ]);
        }

    }
}
