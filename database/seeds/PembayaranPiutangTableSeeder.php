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
            $pembayaran = $faker->randomElement(['tunai', 'kredit', 'giro', 'transfer']);
        	$data[] = [
                "user_id" => rand(1, 4),
        		"penjualan_id" => $id,
                "no_pelunasan" => "BM-19".(substr((100001 + $i), 1)),
                "piutang" => $piutang,
                "dibayarkan" => $bool ? $piutang :  ($piutang * 70/100),
                "sisa" => $bool ? 0 : ($piutang * 30/100),
                "status_lunas" => $bool,
                "pembayaran" => $pembayaran,
                "pembayaran_detail" => $pembayaran == 'giro' ? rand(111111111, 999999999) : null,
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
