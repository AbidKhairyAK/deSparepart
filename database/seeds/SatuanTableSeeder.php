<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$satuan = ['pcs', 'lusin', 'cm'];
        for ($i=0; $i < count($satuan); $i++) { 
            $data[$i] = [
                "nama" => $satuan[$i],
            ];
        }

        DB::table('satuan')->truncate();
        DB::table('satuan')->insert($data);
    }
}
