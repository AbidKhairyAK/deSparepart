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

        for ($i=1; $i <= 999; $i++) { 
            $qty = rand(1, 15);
            $diskon = $faker->boolean(20) ? rand(10, 70) : 0;
        	$ppn = rand(1, 10);
        	$tbl = Barang::find(rand(1, 19));
            $hrg_ppn = $tbl->harga_beli + ($tbl->harga_beli * $ppn / 100);
            $hrg_beli = $hrg_ppn - ($hrg_ppn * $diskon / 100);
            $date = date('Y-m-d H:i:s', (time() - (43200 * $i)));

        	$data[] = [
        		"pembelian_id" => ceil($i/10),
        		"barang_id" => $tbl->id,
        		"part_no" => $tbl->part_no,
        		"nama" => $tbl->nama,
        		"qty" => $qty,
                "stok" => $qty,
                "satuan" => $tbl->satuan->nama,
                "harga_asli" => $tbl->harga_beli,
                "harga" => $hrg_beli,
                "ppn" => $ppn,
        		"diskon" => $diskon,
        		"subtotal" => $hrg_beli * $qty,
        		"created_at" => $date,
        		"updated_at" => $date,
        	];
        }

        DB::table('pembelian_detail')->truncate();
        DB::table('pembelian_detail')->insert($data);
    }
}
