<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
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
        		"nama"	=> 'Jabatan 1',
        		"deskripsi"	=> "Deskripsi Jabatan 1",
        	],
        	[
        		"nama"	=> 'Jabatan 2',
        		"deskripsi"	=> "Deskripsi Jabatan 2",
        	],
        	[
        		"nama"	=> 'Jabatan 3',
        		"deskripsi"	=> "Deskripsi Jabatan 3",
        	],
        	[
        		"nama"	=> 'Jabatan 4',
        		"deskripsi"	=> "Deskripsi Jabatan 4",
        	],
        ];

        DB::table('jabatan')->truncate();
        DB::table('jabatan')->insert($data);
    }
}
