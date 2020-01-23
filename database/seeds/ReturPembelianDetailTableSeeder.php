<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Pembelian;
use Faker\Factory;

class ReturPembelianDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $ps = Pembelian::where('status_lunas', 1)->get();

        foreach ($ps as $key => $p) {
            for ($i=1; $i <= 2; $i++) { 
                $pd = $p->pembelian_detail()->get()[$i * 2];
                $qty = rand(1, $pd->qty);

                $data[] = [
                    "retur_pembelian_id" => $key + 1,
                    "pembelian_detail_id" => $pd->id,
                    "qty" => $qty,
                    "biaya" => $pd->harga * $qty,
                    "keterangan" => rand(0, 1) ? $faker->sentence() : null,
                    "created_at" => date('Y-m-d', strtotime($p->created_at) + 86400),
                    "updated_at" => date('Y-m-d', strtotime($p->created_at) + 86400),
                ];

                $pd->update(['retur' => $qty]);
            }
        }

        DB::table('retur_pembelian_detail')->truncate();
        DB::table('retur_pembelian_detail')->insert($data);
    }
}
