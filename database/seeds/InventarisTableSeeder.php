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

            foreach ($invs as $inv) {
                if (!empty($inv->penjualan_detail_id)) {
                    $this->decreaseBarang($barang, $barang->id, $inv->trx_qty);
                }
            }

            $current_stock = Inventaris::with('inventaris_detail')
                        ->where('barang_id', $barang->id)
                        ->orderBy('tanggal', 'desc')
                        ->orderBy('id', 'desc')
                        ->first()
                        ->inventaris_detail()
                        ->sum('inv_stok');

            $barang->update(['stok' => $current_stock]);
        }
    }

    public function decreaseBarang($b, $id, $qty)
    {
        $pds = $b->pembelian_detail()->where('stok', '>', 0)->oldest();
        $pd = $pds->first();

        if (!empty($pd) && $pd->stok >= $qty) {
            $pds->update(['stok' => $pd->stok - $qty]);
        } elseif (!empty($pd)) {
            $pds->update(['stok' => 0]);
            $this->decreaseBarang($b, $id, $qty - $pd->stok);
            return;
        }
    }

    public function beli($inv)
    {
        $latest = DB::table('inventaris')
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('id', 'desc')
                    ->where('barang_id', $inv->barang_id)
                    ->where('tanggal', '<', $inv->tanggal)
                    ->first();

        if ($latest) {
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

    public function jual($inv, $sisa = false, $skip = 1)
    {
        $latest = DB::table('inventaris')
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('id', 'desc')
                    ->where('barang_id', $inv->barang_id)
                    ->where('tanggal', '<', $inv->tanggal)
                    ->first();

        $first = DB::table('inventaris_detail')
                    ->where('inventaris_id', $latest->id)
                    ->where('inv_stok', '>', '0')
                    ->orderBy('id')
                    ->skip($skip - 1)
                    ->take(1)
                    ->first();

        $prevs = DB::table('inventaris_detail')
                    ->where('inventaris_id', $latest->id)
                    ->where('inv_stok', '>', '0')
                    ->orderBy('id')
                    ->skip($skip)
                    ->take(PHP_INT_MAX)
                    ->get();

        $qty    = $sisa ?: $inv->trx_qty;

        if ($first && $first->inv_stok >= $qty) {
            $stok = $first->inv_stok - $qty;

            if ($stok > 0) {
                DB::table('inventaris_detail')->insert([
                    'tanggal'       => $first->tanggal,
                    'inventaris_id' => $inv->id,
                    'inv_qty'       => $first->inv_qty,
                    'inv_stok'      => $stok,
                    'inv_harga'     => $first->inv_harga,
                    'inv_total'     => $first->inv_harga * $stok,
                ]);
            }
            
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

            DB::table('inventaris')->where('id', $inv->id)->update([
                'trx_qty' => $qty,
                'trx_harga' => $first->inv_harga,
                'trx_total' => $qty * $first->inv_harga,
            ]);

        } else if ($first && $first->inv_stok > 0) {
            DB::table('inventaris')->insert([
                'tanggal'               => $inv->tanggal,
                'barang_id'             => $inv->barang_id,
                'penjualan_detail_id'   => $inv->penjualan_detail_id,
                'trx_qty'               => $first->inv_stok,
                'trx_harga'             => $first->inv_harga,
                'trx_total'             => $first->inv_stok * $first->inv_harga,
            ]);

            DB::table('inventaris')->where('id', $inv->id)->update([
                'trx_qty'   => $first->inv_stok,
                'trx_harga' => $first->inv_harga,
                'trx_total' => $first->inv_stok * $first->inv_harga,
            ]);

            $new_inv = DB::table('inventaris')
                        ->where('penjualan_detail_id', $inv->penjualan_detail_id)
                        ->orderBy('id', 'desc')
                        ->first();

            // habiskan stok inventaris_detail
            $this->jual($new_inv, $qty - $first->inv_stok, $skip + 1);
        }
    }
}
