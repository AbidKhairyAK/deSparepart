<?php

use Illuminate\Database\Seeder; 
use App\Model\Barang;

class TestBarangDetailStok extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bs = Barang::all();

        foreach ($bs as $b) {
			$pds = $b->pembelian_detail()->orderBy('created_at')->get();

        	foreach ($pds as $key => $pd) {
        		if ($key > 2) break;
        		$pd->update(['stok' => 0]);
        	}
        }
    }
}
