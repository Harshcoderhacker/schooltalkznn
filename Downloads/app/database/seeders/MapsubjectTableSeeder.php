<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use Illuminate\Database\Seeder;

class MapsubjectTableSeeder extends Seeder
{
    public function run()
    {
        $subject = Subject::where('active', true)->get();
        foreach ($subject as $key => $value) {
            Mapsubject::create([
                'id' => $key + 1,
                'subject_id' => $value->id,
                'created_by' => 'Admin',
                'user_id' => 1,
                'active' => 1,
            ]);
        }

    }
}
