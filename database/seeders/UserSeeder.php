<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'lastname' => 'Admin',
            'firstname' => 'Admin',
            'phone' => '998333393885',
            'role' => 'admin',
            'status' => 'active',
            'gender' => 'male',
            'birthday' => '2002-08-02',
            'password' => Hash::make('sardorb3k@S'),
        ]);
    }
}
