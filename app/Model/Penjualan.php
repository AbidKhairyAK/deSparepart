<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
	protected $table = 'penjualan';

    protected $fillable = [
    	'id', "user_id", "customer_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan"	
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
