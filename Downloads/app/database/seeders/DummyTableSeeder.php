<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DummyTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ClassroutineTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(ClassmasterTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(StaffdepartmentTableSeeder::class);
        $this->call(StaffdesignationTableSeeder::class);

        $this->call(HolidayTableSeeder::class);
        $this->call(FieldTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(MapclassTableSeeder::class);
        $this->call(MapsubjectTableSeeder::class);
        // $this->call(FeedtagTableSeeder::class);
    }
}
