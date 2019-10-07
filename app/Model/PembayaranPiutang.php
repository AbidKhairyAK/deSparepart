<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PembayaranPiutang extends Model
{
	protected $table = 'pembayaran_piutang';

    protected $fillable = [
    	'id', "penjualan_id", "user_id", "no_nota", "piutang", "dibayarkan", "sisa", "status_lunas"
	];

    public function penjualan()
    {
    	return $this->belongsTo(Penjualan::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
