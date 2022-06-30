<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        DB::table('users')->insert([
            'name' => 'Fikri Darmawan',
            'username' => 'super_fikri',
            'email' => 'fikri@kemilauabadi.com',
            'password' => Hash::make('fikri123'),
            'role_id' => 1
        ]);
    }
}
