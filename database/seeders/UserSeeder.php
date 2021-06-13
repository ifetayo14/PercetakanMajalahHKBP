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
        DB::table('user')->insert([
            'id' => '1',
            'username' => 'admin',
            'password' => 'pass123',
            'role' => 'admin',
            'name' => 'John Snow',
        ]);

        DB::table('user')->insert([
            'id' => '2',
            'username' => 'testJemaat',
            'password' => 'pass123',
            'role' => 'jemaat',
            'name' => 'Rob Stark',
        ]);

        DB::table('user')->insert([
            'id' => '3',
            'username' => 'testPendeta',
            'password' => 'pass123',
            'role' => 'pendeta',
            'name' => 'Sansa Stark',
        ]);

        DB::table('user')->insert([
            'id' => '4',
            'username' => 'testSekjen',
            'password' => 'pass123',
            'role' => 'sekjen',
            'name' => 'Arya Stark',
        ]);

        DB::table('user')->insert([
            'id' => '5',
            'username' => 'testTimMajalah',
            'password' => 'pass123',
            'role' => 'timMajalah',
            'name' => 'Bran Stark',
        ]);
    }
}
