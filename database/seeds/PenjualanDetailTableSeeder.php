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

		$this->command->getOutput()->progressStart(600);

		for ($i=1; $i <= 600; $i++) { 
			$qty = rand(10, 15);
			$diskon = $faker->boolean(20) ? rand(10, 70) : 0;
			$tbl = Barang::find( ($i % 20) + 1 );
			$harga_jual = $tbl->harga_jual - ($tbl->harga_jual * $diskon / 100);
			$penjualan_id = ceil($i/5);
            $date = date('Y-m-d H:i:s', (time() - (876000 * $penjualan_id)));

			$data[] = [
				"penjualan_id"	=> $penjualan_id,
				"barang_id"   	=> $tbl->id,
				"part_no"     	=> $tbl->part_no,
				"nama"        	=> $tbl->nama,
				"qty"			=> $qty,
				"satuan"		=> $tbl->satuan->nama,
				"harga_asli" 	=> $tbl->harga_jual,
				"harga" 		=> $harga_jual,
				"diskon" 		=> $diskon,
				"subtotal" 		=> $harga_jual * $qty,
				"created_at"	=> $date,
				"updated_at" 	=> $date,
			];

			$this->command->getOutput()->progressAdvance();
		}

		DB::table('penjualan_detail')->truncate();
		DB::table('penjualan_detail')->insert($data);

		$this->command->getOutput()->progressFinish();
	}
}
