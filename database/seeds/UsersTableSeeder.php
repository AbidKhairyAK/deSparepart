<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		"role_id"	=> 1,
        		"username"	=> "Test Admin",
        		"email"		=> "test@admin.com",
        		"password"	=> bcrypt("manisbetul"),
                "last_login"=> now(),
                "created_at"=> now(),
        	],
        	[
        		"role_id"	=> 2,
        		"username"	=> "Test Karyawan",
        		"email"		=> "test@karyawan.com",
        		"password"	=> bcrypt("manisbetul"),
                "last_login"=> now(),
                "created_at"=> now(),
        	],
        	[
        		"role_id"	=> 3,
        		"username"	=> "Test Kasir",
        		"email"		=> "test@kasir.com",
        		"password"	=> bcrypt("manisbetul"),
                "last_login"=> now(),
                "created_at"=> now(),
        	],
        	[
        		"role_id"	=> 4,
        		"username"	=> "Test Gudang",
        		"email"		=> "test@gudang.com",
        		"password"	=> bcrypt("manisbetul"),
                "last_login"=> now(),
                "created_at"=> now(),
        	],
        ];

        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
