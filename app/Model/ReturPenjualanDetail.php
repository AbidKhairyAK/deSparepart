<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPenjualanDetail extends Model
{
    protected $table = 'retur_penjualan_detail';

    protected $fillable = [
    	'id', "penjualan_detail_id", "retur_penjualan_id", "qty", "biaya", "keterangan"
    ];

    public function retur_penjualan()
    {
        return $this->belongsTo(ReturPenjualan::class);
    }

    public function penjualan_detail()
    {
    	return $this->belongsTo(PenjualanDetail::class);
    }
}
