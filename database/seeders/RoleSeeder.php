<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nama_role' => 'superuser'
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'operator'
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'ss_admin'
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'sales'
        ]);
        DB::table('roles')->insert([
            'nama_role' => 'customer'
        ]);
    }
}
