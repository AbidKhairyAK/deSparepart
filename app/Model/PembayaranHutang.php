<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PembayaranHutang extends Model
{
	protected $table = 'pembayaran_hutang';

    protected $fillable = [
    	'id', "pembelian_id", "user_id", "no_pelunasan", "hutang", "dibayarkan", "pembayaran", "pembayaran_detail", "sisa", "status_lunas"
	];

    public function pembelian()
    {
    	return $this->belongsTo(Pembelian::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
