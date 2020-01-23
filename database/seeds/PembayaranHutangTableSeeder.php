<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PembayaranHutangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $list = DB::table('pembelian')->where('status_lunas', '0')->pluck('id');

        for ($i=0; $i < 3; $i++) { 
            $id = $faker->unique()->randomElement($list);
            $pembelian = DB::table('pembelian')->where('id', $id)->first();
            $hutang = $pembelian->hutang;
            $bool = $i < 2;
            $pembayaran = $faker->randomElement(['tunai', 'kredit', 'giro', 'transfer']);
        	$data[] = [
                "user_id" => rand(1, 4),
        		"pembelian_id" => $id,
                "no_pelunasan" => "BK-19".(substr((100001 + $i), 1)),
                "hutang" => $hutang,
                "dibayarkan" => $bool ? $hutang :  ($hutang * 70/100),
                "sisa" => $bool ? 0 : ($hutang * 30/100),
                "status_lunas" => $bool,
                "pembayaran" => $pembayaran,
                "pembayaran_detail" => $pembayaran == 'giro' ? rand(111111111, 999999999) : null,
        		"created_at" => now(),
        		"updated_at" => now(),
        	];

            if ($bool) {
                DB::table('pembelian')->where('id', $id)->update(['status_lunas' => $bool]);
            }
        }

        DB::table('pembayaran_hutang')->truncate();
        DB::table('pembayaran_hutang')->insert($data);
    }
}
