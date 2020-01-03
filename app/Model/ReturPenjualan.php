->withTrashed();<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturPenjualan extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
	protected $table = 'retur_penjualan';

    protected $fillable = [
    	'id', "user_id", "penjualan_id", "pembayaran_piutang_id", "dilunaskan", "dikembalikan", "pembayaran"
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class)->withTrashed();
    }

    public function pembayaran_piutang()
    {
        return $this->belongsTo(PembayaranPiutang::class)->withTrashed();
    }

    public function retur_penjualan_detail()
    {
    	return $this->hasMany(ReturPenjualanDetail::class);
    }
}
