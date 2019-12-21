<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventaris')->truncate();
        DB::table('inventaris_detail')->truncate();

        $faker = Factory::create();

        for ($i=0; $i < 20; $i++) { 
            $hrg_beli = rand(1, 50) * 10000;
            $hrg_jual = $hrg_beli + ($hrg_beli * 10 / 100);
        	$data[] = [
                'user_id' => rand(1, 4),
                'komponen_id' => rand(1, 20),
                'kendaraan_id' => rand(1, 0) ? rand(2, 20) : 1,
                'satuan_id' => rand(1,3),
                'part_no' => (rand(1111, 9999) * 10000).(rand(1111, 9999)),
                'nama' => $faker->sentence(2),
                'merk' => $faker->word,
                'stok' => rand(1, 200),
                'limit' => rand(1, 20),
                'harga_beli' => $hrg_beli,
                'harga_jual' => $hrg_jual,
                'keterangan' => $faker->sentence(),
                'gambar' => '000000000'.rand(1,2).'.jpg',
        		'created_at' => now(),
        		'updated_at' => now(),
        	];

            DB::table('inventaris')->insert([
                'tanggal' => '2000-01-01 00:00:00',
                'barang_id' => $i + 1,
            ]);

            DB::table('inventaris_detail')->insert([
                'tanggal' => '2000-01-01 00:00:00',
                'inventaris_id' => $i + 1,
                'inv_qty' => $data[$i]['stok'],
                'inv_stok' => $data[$i]['stok'],
                'inv_harga' => $data[$i]['harga_beli'],
                'inv_total' => $data[$i]['harga_beli'] * $data[$i]['stok'],
            ]);
        }
        
        DB::table('barang')->truncate();
        DB::table('barang')->insert($data);
    }
}
