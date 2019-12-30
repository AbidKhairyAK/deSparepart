<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PembayaranPiutang extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'pembayaran_piutang';

    protected $fillable = [
    	'id', "penjualan_id", "user_id", "no_pelunasan", "piutang", "dibayarkan", "pembayaran", "pembayaran_detail", "sisa", "status_lunas"
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
