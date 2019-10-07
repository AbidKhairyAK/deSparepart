<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
	protected $table = 'penjualan';

    protected $fillable = [
    	'id', "user_id", "pelanggan_id", "no_faktur", "no_nota", "pembayaran", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan"	
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function penjualan_detail()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function pembayaran_piutang()
    {
    	return $this->hasMany(PembayaranPiutang::class);
    }
}
