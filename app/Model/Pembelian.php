<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

	protected $table = 'pembelian';

    protected $fillable = [
    	'id', "user_id", "supplier_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan"
    ];

    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function pembelian_detail()
    {
        return $this->hasMany(PembelianDetail::class);
    }

    public function pembayaran_hutang()
    {
    	return $this->hasMany(PembayaranHutang::class)->withTrashed();
    }

    public function retur_pembelian()
    {
        return $this->hasOne(ReturPembelian::class)->withTrashed();
    }
}
