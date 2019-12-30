<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pembelian extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'pembelian';

    protected $fillable = [
    	'id', "user_id", "supplier_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan"
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function pembelian_detail()
    {
        return $this->hasMany(PembelianDetail::class);
    }

    public function pembayaran_hutang()
    {
    	return $this->hasMany(PembayaranHutang::class);
    }
}
