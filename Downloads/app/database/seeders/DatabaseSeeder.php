<?php

namespace Database\Seeders;

use Database\Seeders\AcademicyearTableSeeder;
use Database\Seeders\ClasstypeTableSeeder;
use Database\Seeders\ComplainttypeTableSeeder;
use Database\Seeders\FcmintegrationTableSeeder;
use Database\Seeders\FeedreportedTableSeeder;
use Database\Seeders\GeneralsettingsTableSeeder;
use Database\Seeders\LanguageTableSeeder;
use Database\Seeders\LeavetypeTableSeeder;
use Database\Seeders\MonthlistsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\SettingsintegrationTableSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WeekendTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(GeneralsettingsTableSeeder::class);
        $this->call(SettingsintegrationTableSeeder::class);
        $this->call(FeedreportedTableSeeder::class);
        $this->call(WeekendTableSeeder::class);
        $this->call(ClasstypeTableSeeder::class);
        $this->call(AcademicyearTableSeeder::class);
        $this->call(FcmintegrationTableSeeder::class);
        $this->call(LeavetypeTableSeeder::class);
        $this->call(ComplainttypeTableSeeder::class);
        $this->call(MonthlistsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        $this->call(DummyTableSeeder::class);
        //Need To Delete
        // if (env('APP_ENV') == 'local') {
        //     $this->call(DummyTableSeeder::class);
        // }
    }
}
