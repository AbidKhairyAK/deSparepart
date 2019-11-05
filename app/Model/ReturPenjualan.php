<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPenjualan extends Model
{
	protected $table = 'retur_penjualan';

    protected $fillable = [
    	'id', "penjualan_id", "penjualan_detail_id", "qty", "biaya", "pembayaran", "keterangan"
    ];

    public function penjualan()
    {
    	return $this->belongsTo(Penjualan::class);
    }

    public function penjualan_detail()
    {
        return $this->belongsTo(PenjualanDetail::class);
    }
}
