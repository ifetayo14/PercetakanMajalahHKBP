<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'Role_Id' => '1',
            'Role_Name' => 'admin',
        ]);

        DB::table('role')->insert([
            'Role_Id' => '2',
            'Role_Name' => 'jemaat',
        ]);

        DB::table('role')->insert([
            'Role_Id' => '3',
            'Role_Name' => 'pendeta',
        ]);

        DB::table('role')->insert([
            'Role_Id' => '4',
            'Role_Name' => 'sekjen',
        ]);

        DB::table('role')->insert([
            'Role_Id' => '5',
            'Role_Name' => 'timMajalah',
        ]);
    }
}
