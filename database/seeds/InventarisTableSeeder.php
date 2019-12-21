<?php

use Illuminate\Database\Seeder;
use App\Model\Barang;
use App\Model\Inventaris;

class InventarisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangs = Barang::all();

        foreach ($barangs as $barang) {
        	foreach ($barang->pembelian_detail()->orderBy('created_at')->get() as $detail) {
        		DB::table('inventaris')->insert([
                    'tanggal'               => $detail->created_at,
        			'barang_id'				=> $barang->id,
        			'pembelian_detail_id'	=> $detail->id,
        			'trx_qty'				=> $detail->qty,
        			'trx_harga'				=> $detail->harga,
        			'trx_total'				=> $detail->subtotal,
        		]);
        	}
        	foreach ($barang->penjualan_detail()->orderBy('created_at')->get() as $detail) {
        		DB::table('inventaris')->insert([
                    'tanggal'               => $detail->created_at,
        			'barang_id'				=> $barang->id,
        			'penjualan_detail_id'	=> $detail->id,
        			'trx_qty'				=> $detail->qty,
        			'trx_harga'				=> $detail->harga,
        			'trx_total'				=> $detail->subtotal,
        		]);
        	}

            $invs = DB::table('inventaris')
                        ->where('barang_id', $barang->id)
                        ->orderBy('tanggal', 'asc')
                        ->get();

            foreach($invs as $inv) {
                if (!empty($inv->pembelian_detail_id)) {
                    $this->beli($inv);
                } elseif (!empty($inv->penjualan_detail_id)) {
                    $this->jual($inv);
                }
            }
        }
    }

    private function beli($inv)
    {
        $latest = DB::table('inventaris')
                    ->orderBy('tanggal', 'desc')
                    ->where('barang_id', $inv->barang_id)
                    ->where('tanggal', '<', $inv->tanggal)
                    ->first();

        $prevs = DB::table('inventaris_detail')
                    ->where('inventaris_id', $latest->id)
                    ->orderBy('tanggal')
                    ->get();

        foreach ($prevs as $prev) {
            DB::table('inventaris_detail')->insert([
                'tanggal'       => $prev->tanggal,
                'inventaris_id' => $inv->id,
                'inv_qty'       => $prev->inv_qty,
                'inv_stok'      => $prev->inv_stok,
                'inv_harga'     => $prev->inv_harga,
                'inv_total'     => $prev->inv_total,
            ]);
        }
        DB::table('inventaris_detail')->insert([
            'tanggal'       => $inv->tanggal,
            'inventaris_id' => $inv->id,
            'inv_qty'       => $inv->trx_qty,
            'inv_stok'      => $inv->trx_qty,
            'inv_harga'     => $inv->trx_harga,
            'inv_total'     => $inv->trx_total,
        ]);
    }

    private function jual($inv)
    {
    	
    }
}
