<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\PenjualanDetail;
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

        for ($i=1; $i <= 100; $i++) { 
            $id = (ceil($i/2) * 10) + ($i%2);
            $p = PenjualanDetail::find($id);
            $qty = rand(1, $p->qty);

            $data[$i] = [
                "user_id" => 1,
                "penjualan_id" => $p->penjualan->id,
                "penjualan_detail_id" => $id,
                "qty" => $qty,
                "biaya" => $p->harga * $qty,
                "pembayaran" => $p->penjualan->pembayaran,
                "keterangan" => $faker->sentence(),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        DB::table('retur_penjualan')->truncate();
        DB::table('retur_penjualan')->insert($data);
    }
}
