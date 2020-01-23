<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Penjualan;
use Faker\Factory;

class ReturPenjualanDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $ps = Penjualan::where('status_lunas', 1)->get();

        foreach ($ps as $key => $p) {
            $pd = $p->penjualan_detail()->get()[rand(1, 3)];
            $qty = $pd->qty <= 3 ? rand(1, $pd->qty) : rand(1, 3);

            $data[] = [
                "retur_penjualan_id" => $key + 1,
                "penjualan_detail_id" => $pd->id,
                "qty" => $qty,
                "biaya" => $pd->harga * $qty,
                "keterangan" => rand(0, 1) ? $faker->sentence() : null,
                "created_at" => date('Y-m-d', strtotime($p->created_at) + 86400),
                "updated_at" => date('Y-m-d', strtotime($p->created_at) + 86400),
            ];

            $pd->update(['retur' => $qty]);
        }

        DB::table('retur_penjualan_detail')->truncate();
        DB::table('retur_penjualan_detail')->insert($data);
    }
}
