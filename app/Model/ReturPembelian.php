<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturPembelian extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
	protected $table = 'retur_pembelian';

    protected $fillable = [
    	'id', "user_id", "pembelian_id", "pembayaran_hutang_id", "dilunaskan", "dikembalikan", "pembayaran"
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class)->withTrashed();
    }

    public function pembayaran_hutang()
    {
        return $this->belongsTo(PembayaranHutang::class)->withTrashed();
    }

    public function retur_pembelian_detail()
    {
    	return $this->hasMany(ReturPembelianDetail::class);
    }
}
