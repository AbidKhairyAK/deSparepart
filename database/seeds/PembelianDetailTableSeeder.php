<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Model\Barang;

class PembelianDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i <= 2999; $i++) { 
            $qty = rand(1, 15);
            $diskon = $faker->boolean(20) ? rand(10, 70) : 0;
        	$ppn = rand(1, 9);
        	$tbl = Barang::find(rand(1, 19));
            $hrg_beli = $tbl->harga_beli + ($tbl->harga_beli * $ppn / 100);

        	$data[] = [
        		"pembelian_id" => ceil($i/15),
        		"barang_id" => $tbl->id,
        		"part_no" => $tbl->part_no,
        		"nama" => $tbl->nama,
        		"qty" => $qty,
                "satuan" => $tbl->satuan->nama,
                "harga" => $hrg_beli,
                "ppn" => $ppn,
        		"diskon" => $diskon,
        		"subtotal" => ($hrg_beli - ($hrg_beli * $diskon / 100)) * $qty,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('pembelian_detail')->truncate();
        DB::table('pembelian_detail')->insert($data);
    }
}
