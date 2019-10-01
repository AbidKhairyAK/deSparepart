<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = ["Admin", "Karyawan", "Kasir", "Gudang"];

        for ($i=0; $i < count($roles); $i++) { 
            $data[$i] = [
                "name" => $roles[$i],
                "slug" => str_slug($roles[$i]),
            ];
        }

        DB::table('roles')->truncate();
        DB::table('roles')->insert($data);
    }
}
