<?php

namespace Database\Seeders;

use App\Models\Admin\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // if (env('APP_ENV') != 'local') {

        $user = User::create([
            'name' => 'Formula5',
            'uniqid' => 'A-00001',
            'phone' => 9551165555,
            'dob' => Carbon::now()->subYear(20),
            'email' => 'admin@formula5.in',
            'is_accountactive' => 1,
            'password' => 12345678,
        ]);

        // } else {
        $user = User::create([
            'name' => 'Vineeth',
            'uniqid' => 'A-00002',
            'phone' => 8525843447,
            'dob' => Carbon::now()->subYear(20),
            'email' => 'admin@edfish.in',
            'is_accountactive' => 1,
            'password' => 12345678,
        ]);

        $user = User::create([
            'name' => 'Admin',
            'uniqid' => 'A-00003',
            'phone' => 1234567890,
            'dob' => Carbon::now()->subYear(10),
            'email' => 'admin@gmail.com',
            'is_accountactive' => 1,
            'password' => 12345678,
        ]);

        // $user = Aparent::create([
        //     'name' => 'Raju',
        //     'uniqid' => 'P-00001',
        //     'phone' => 1234567890,
        //     'email' => 'parent@edfish.in',
        //     'is_accountactive' => 1,
        //     'password' => 12345678,
        //     'current_password' => 12345678,
        //     'mother_name' => 'mother_name',
        //     'mother_occupation' => 'mother_occupation',
        //     'mother_phoneno' => '1234567890',
        //     'father_name' => 'father_name',
        //     'father_occupation' => 'father_occupation',
        //     'father_phoneno' => '1234567890',
        //     'father_office_address' => 'father_office_address',
        // ]);
        // }

        // $user = User::create([
        //     'name' => 'Ronald',
        //     'uniqid' => 'A-00002',
        //     'phone' => 1234567891,
        //     'dob' => Carbon::now()->subYear(20),
        //     'email' => 'admintwo@edfish.in',
        //     'is_accountactive' => 1,
        //     'password' => 12345678,
        // ]);

        // Roles and Permission
        // $role = Role::create([
        //     'name' => 'Admin',
        //     'created_by' => 'Admin',
        // ]);
        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);

        // Fake users
        // User::factory()->times(9)->create();
    }
}
