<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\Schoolsetting\Generalsetting;
use Illuminate\Database\Seeder;

class GeneralsettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Generalsetting::create([
            'schoolname' => 'St.Xaviers Matriculation Matric Hr.Sec.School',
            'apptitle' => 'School Software',
            'address' => '1/153 Madhavan Nagar,Chennai - 600016',
            'phone' => '+91 4423 2265',
            'email' => 'info@xavier.co.in',
            'code' => 'sCX100',
            'academicyear_id' => 1,
            'academicyear' => 2022,
            'language' => 'English',

            'logo' => '',
            'favicon' => '',
        ]);
    }
}
