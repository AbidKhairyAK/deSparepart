<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\ReturPembelianDetail;
use Faker\Factory;

class ReturPembelianTableSeeder extends Seeder
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
        
        $p = ReturPembelianDetail::select(DB::raw('SUM(biaya) as total, pembelian_detail_id'))->groupBy('retur_pembelian_id')->get();

        foreach ($p as $key => $pd) {
            $pembayaran = $faker->randomElement(['tunai', 'giro', 'kredit', 'transfer']);
            $data[] = [
                "user_id" => rand(1, 4),
                "pembelian_id" => $pd->pembelian_detail->pembelian_id,
                "pembayaran_hutang_id" => null,
                "pembayaran" => $pembayaran,
                'pembayaran_detail' => $pembayaran == 'giro' ? $faker->isbn13 : null,
                "dilunaskan" => 0,
                "dikembalikan" => $pd->total,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        DB::table('retur_pembelian')->truncate();
        DB::table('retur_pembelian')->insert($data);
    }
}
