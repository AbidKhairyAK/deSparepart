<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\ReturPenjualanDetail;
use Faker\Factory;

class ReturPenjualanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        
        $p = ReturPenjualanDetail::select(DB::raw('SUM(biaya) as total, penjualan_detail_id'))->groupBy('retur_penjualan_id')->get();

        foreach ($p as $key => $pd) {
            $pembayaran = $faker->randomElement(['tunai', 'giro', 'kredit', 'transfer']);
            $data[] = [
                "user_id" => 1,
                "penjualan_id" => $pd->penjualan_detail->penjualan_id,
                "pembayaran_piutang_id" => null,
                "pembayaran" => $pembayaran,
                'pembayaran_detail' => $pembayaran == 'giro' ? $faker->isbn13 : null,
                "dilunaskan" => 0,
                "dikembalikan" => $pd->total,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        DB::table('retur_penjualan')->truncate();
        DB::table('retur_penjualan')->insert($data);
    }
}
