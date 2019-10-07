<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PembayaranPiutangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $list = DB::table('penjualan')->where('status_lunas', '0')->pluck('id');

        for ($i=0; $i < 3; $i++) { 
            $id = $faker->unique()->randomElement($list);
            $penjualan = DB::table('penjualan')->where('id', $id)->first();
            $piutang = $penjualan->hutang;
            $bool = $i < 2;
        	$data[] = [
                "user_id" => rand(1, 4),
        		"penjualan_id" => $id,
                "no_nota" => "1909282".rand(10, 99),
                "piutang" => $piutang,
                "dibayarkan" => $bool ? $piutang :  ($piutang * 70/100),
                "sisa" => $bool ? 0 : ($piutang * 30/100),
                "status_lunas" => $bool,
                "pembayaran" => $faker->randomElement(['tunai', 'kredit', 'giro']),
        		"created_at" => now(),
        		"updated_at" => now(),
        	];

            if ($bool) {
                DB::table('penjualan')->where('id', $id)->update(['status_lunas' => $bool]);
            }
        }

        DB::table('pembayaran_piutang')->truncate();
        DB::table('pembayaran_piutang')->insert($data);
    }
}
