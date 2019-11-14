<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPembelianDetail extends Model
{
    protected $table = 'retur_pembelian_detail';

    protected $fillable = [
    	'id', "pembelian_detail_id", "retur_pembelian_id", "qty", "biaya", "keterangan"
    ];

    public function retur_pembelian()
    {
        return $this->belongsTo(ReturPembelian::class);
    }

    public function pembelian_detail()
    {
    	return $this->belongsTo(PembelianDetail::class);
    }
}
