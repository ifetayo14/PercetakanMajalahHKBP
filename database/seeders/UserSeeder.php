<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'User_Id' => '1',
            'username' => 'admin',
            'alamat' => 'Balige',
            'email' => 'admin@gmail.com',
            'password' => 'pass123',
            'role' => '1',
        ]);

        DB::table('users')->insert([
            'User_Id' => '2',
            'username' => 'testJemaat',
            'alamat' => 'Medan',
            'email' => 'jemaat@gmail.com',
            'password' => 'pass123',
            'role' => '2',
        ]);

        DB::table('users')->insert([
            'User_Id' => '3',
            'username' => 'testPendeta',
            'alamat' => 'Laguboti',
            'email' => 'pendeta@gmail.com',
            'password' => 'pass123',
            'role' => '3',
        ]);

        DB::table('users')->insert([
            'User_Id' => '4',
            'username' => 'testSekjen',
            'alamat' => 'Balige',
            'email' => 'sekjen@gmail.com',
            'password' => 'pass123',
            'role' => '4',
        ]);

        DB::table('users')->insert([
            'User_Id' => '5',
            'username' => 'testTimMajalah',
            'alamat' => 'Porsea',
            'email' => 'majalah@gmail.com',
            'password' => 'pass123',
            'role' => '5',
        ]);
    }
}
