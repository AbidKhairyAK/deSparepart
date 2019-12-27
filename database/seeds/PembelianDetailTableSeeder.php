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

        for ($i=1; $i <= 200; $i++) { 
            $qty = $i == 200 ? rand(80, 100) : rand(20, 40);
            $diskon = $faker->boolean(20) ? rand(10, 70) : 0;
        	$ppn = rand(1, 10);
        	$tbl = Barang::find(($i % 20) + 1 );
            $hrg_ppn = $tbl->harga_beli + ($tbl->harga_beli * $ppn / 100);
            $hrg_beli = $hrg_ppn - ($hrg_ppn * $diskon / 100);
            $pembelian_id = ceil($i/5);
            $date = date('Y-m-d H:i:s', (time() - (2628000 * $pembelian_id)));

        	$data[] = [
        		"pembelian_id" => $pembelian_id,
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

        $barang = DB::table('barang')->orderBy('id')->get();
        foreach ($barang as $b) {
            DB::table('pembelian_detail')->insert([
                "pembelian_id" => 1,
                "barang_id" => $b->id,
                "part_no" => $b->part_no,
                "nama" => $b->nama,
                "qty" => $b->stok,
                "stok" => $b->stok,
                "satuan" => DB::table('satuan')->where('id', $b->satuan_id)->first()->nama,
                "harga_asli" => $b->harga_beli,
                "harga" => $b->harga_beli,
                "ppn" => 0,
                "diskon" => 0,
                "subtotal" => $b->stok * $b->harga_beli,
                "created_at" => '2000-01-01 00:00:00',
                "updated_at" => '2000-01-01 00:00:00',
            ]);
        }
        
        DB::table('pembelian_detail')->insert($data);
    }
}
