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

        for ($i=1; $i < 20; $i++) { 
        	$paid = rand(0, 1);
        	$total = DB::table('penjualan_detail')->where('penjualan_id', $i)->sum('subtotal');
            $pembayaran = $faker->randomElement(['tunai', 'kredit', 'giro', 'transfer']);
        	$data[] = [
        		"user_id" => rand(1, 4),
        		"customer_id" => rand(1, 9),
        		"no_faktur" => '0'.rand(1,9).rand(0,1).'.00'.rand(1,4).'-'.rand(10, 19).'.00000'.rand(100,999),
        		"no_nota" => "1909280".rand(10, 99),
                "pembayaran" => $pembayaran,
                "pembayaran_detail" => $pembayaran == 'giro' ? rand(111111111, 999999999) : null,
        		"dibayarkan" => !$paid ? ($total * 70/100) : $total,
        		"hutang" => !$paid ? ($total * 30/100) : 0,
        		"status_lunas" => $paid,
        		"status_post" => rand(0, 1),
        		"jatuh_tempo" => !$paid ? date('Y-m-d', (time()+604800)) : null,
        		"total" => $total,
        		"keterangan" => $faker->sentence,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];
        }

        DB::table('penjualan')->truncate();
        DB::table('penjualan')->insert($data);
    }
}
