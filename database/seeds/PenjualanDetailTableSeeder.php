<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Model\Barang;

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

		for ($i=1; $i <= 149; $i++) { 
			$qty = rand(1, 5);
			$diskon = $faker->boolean(20) ? rand(10, 70) : 0;
			$tbl = Barang::find(rand(1, 19));
			$harga_jual = $tbl->harga_jual - ($tbl->harga_jual * $diskon / 100);

			$data[] = [
				"penjualan_id"	=> ceil($i/15),
				"barang_id"   	=> $tbl->id,
				"part_no"     	=> $tbl->part_no,
				"nama"        	=> $tbl->nama,
				"qty"			=> $qty,
				"satuan"		=> $tbl->satuan->nama,
				"harga_asli" 	=> $tbl->harga_jual,
				"harga" 		=> $harga_jual,
				"diskon" 		=> $diskon,
				"subtotal" 		=> $harga_jual * $qty,
				"created_at"	=> now(),
				"updated_at" 	=> now(),
			];
		}

		DB::table('penjualan_detail')->truncate();
		DB::table('penjualan_detail')->insert($data);
	}
}
