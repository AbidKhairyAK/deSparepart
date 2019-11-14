<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
	protected $table = 'retur_pembelian';

    protected $fillable = [
    	'id', "user_id", "pembelian_id", "pembayaran_hutang_id", "dilunaskan", "dikembalikan", "pembayaran"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function pembayaran_hutang()
    {
        return $this->belongsTo(PembayaranHutang::class);
    }

    public function retur_pembelian_detail()
    {
    	return $this->hasMany(ReturPembelianDetail::class);
    }
}
