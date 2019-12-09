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
            for ($i=1; $i <= 2; $i++) { 
                $pd = $p->penjualan_detail()->get()[$i * 3];
                $qty = rand(1, $pd->qty);

                $data[] = [
                    "retur_penjualan_id" => $key + 1,
                    "penjualan_detail_id" => $pd->id,
                    "qty" => $qty,
                    "biaya" => $pd->harga * $qty,
                    "keterangan" => rand(0, 1) ? $faker->sentence() : null,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }
        }

        DB::table('retur_penjualan_detail')->truncate();
        DB::table('retur_penjualan_detail')->insert($data);
    }
}
