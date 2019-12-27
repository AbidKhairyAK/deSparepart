<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PenjualanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i <= 120; $i++) { 
        	$paid = rand(0, 1);
        	$pds = DB::table('penjualan_detail')->where('penjualan_id', $i);
            $total = $pds->sum('subtotal');
            $tanggal = $pds->first()->created_at;
            $pembayaran = $faker->randomElement(['tunai', 'kredit', 'giro', 'transfer']);

        	$data[] = [
        		"user_id" => rand(1, 4),
        		"customer_id" => rand(1, 9),
        		"no_faktur" => "NJA-".date('y/m/').substr((100000 + $i), 1),
        		"no_po" => rand(0,1) ? rand(111111111, 999999999) : null,
                "pembayaran" => $pembayaran,
                "pembayaran_detail" => $pembayaran == 'giro' ? rand(111111111, 999999999) : null,
        		"dibayarkan" => !$paid ? ($total * 70/100) : $total,
        		"hutang" => !$paid ? ($total * 30/100) : 0,
        		"status_lunas" => $paid,
        		"status_post" => rand(0, 1),
        		"jatuh_tempo" => !$paid ? date('Y-m-d', (time()+604800)) : null,
        		"total" => $total,
        		"keterangan" => $faker->sentence,
        		"created_at" => $tanggal,
        		"updated_at" => $tanggal,
        	];
        }

        DB::table('penjualan')->truncate();
        DB::table('penjualan')->insert($data);
    }
}
