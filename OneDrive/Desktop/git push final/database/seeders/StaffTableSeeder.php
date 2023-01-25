<?php

namespace Database\Seeders;

use Database\Seeders\StaffTableSeeder;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $staff = Staff::create([
        //     'id' => 1,
        //     'name' => 'Kamesh',
        //     'staff_roll_id' => 100,
        //     'marital_status' => 1,
        //     'gender' => 1,
        //     'role' => 1,
        //     'phone' => 1234567890,
        //     'dob' => Carbon::now()->subYear(10),
        //     'email' => 'preparenext@gmail.com',
        //     'is_accountactive' => 1,
        //     'password' => 12345678,
        //     'staffdepartment_id' => 1,
        //     'staffdesignation_id' => 1,
        //     'basic_salary' => 10000,
        //     'doj' => Carbon::now()->subYear(1),
        // ]);

        // $staff->classroutine()
        //     ->sync(Classroutine::where('active', true)
        //             ->pluck('id'));

        // $staffotherdetail = new Staffotherdetail();
        // $staffotherdetail->staff_id = $staff->id;
        // Staff::find(1)->staffotherdetail()->save($staffotherdetail);

        // $id = 100;
        // for ($i = 0; $i <= 9; $i++) {
        //     $id += $i;
        //     $faker = Factory::create();
        //     $staff = Staff::create([
        //         'staff_roll_id' => $id,
        //         'role' => 1,
        //         'name' => $faker->name,
        //         'marital_status' => 1,
        //         'gender' => 1,
        //         'phone' => rand(1111111111, 9999999999),
        //         'dob' => Carbon::now()->subYear(10),
        //         'email' => $faker->email,
        //         'is_accountactive' => 1,
        //         'password' => 12345678,
        //         'staffdepartment_id' => 1,
        //         'staffdesignation_id' => 1,
        //         'basic_salary' => 10000,
        //         'doj' => Carbon::now()->subYear(1),
        //     ]);

        //     $staff->classroutine()
        //         ->sync(Classroutine::where('active', true)
        //                 ->pluck('id'));

        //     $staffotherdetail = new Staffotherdetail();
        //     $staffotherdetail->staff_id = $staff->id;
        //     $staff->staffotherdetail()->save($staffotherdetail);
        // }
    }
}
