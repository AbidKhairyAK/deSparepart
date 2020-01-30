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
        
        $p = ReturPenjualanDetail::select(DB::raw('SUM(biaya) as total, penjualan_detail_id, created_at'))->groupBy('retur_penjualan_id')->get();

        $count = count($p);
        foreach ($p as $key => $pd) {
            $pembayaran = $faker->randomElement(['tunai', 'giro', 'kredit', 'transfer']);
            $data[] = [
                "user_id" => 1,
                "penjualan_id" => $pd->penjualan_detail->penjualan_id,
                "no_retur" => "RTJ-".date('y/m/', strtotime($pd->created_at)).substr((100000 + ($count - $key)), 1),
                "pembayaran" => $pembayaran,
                'pembayaran_detail' => $pembayaran == 'giro' ? $faker->isbn13 : null,
                "dikembalikan" => $pd->total,
                "created_at" => $pd->created_at,
                "updated_at" => $pd->created_at,
            ];
        }

        DB::table('retur_penjualan')->truncate();
        DB::table('retur_penjualan')->insert($data);
    }
}
