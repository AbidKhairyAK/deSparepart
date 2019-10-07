<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PenjualanDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i <= 94; $i++) { 
            $qty = rand(1, 15);
        	$diskon = $faker->boolean(20) ? rand(10, 70) : 0;
        	$tbl = DB::table('barang')->find(rand(1, 19));

        	$data[] = [
        		"penjualan_id" => ceil($i/5),
        		"barang_id" => $tbl->id,
        		"part_no" => $tbl->part_no,
        		"nama" => $tbl->nama,
        		"qty" => $qty,
                "harga" => $tbl->harga_jual,
        		"diskon" => $diskon,
        		"subtotal" => ($tbl->harga_jual - ($tbl->harga_jual * $diskon / 100)) * $qty,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('penjualan_detail')->truncate();
        DB::table('penjualan_detail')->insert($data);
    }
}
