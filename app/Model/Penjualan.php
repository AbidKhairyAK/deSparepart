<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
	protected $table = 'penjualan';

    protected $fillable = [
    	'id', "user_id", "customer_id", "no_faktur", "no_po", "pembayaran", "pembayaran_detail", "dibayarkan", "hutang", "status_lunas", "status_post", "jatuh_tempo", "total", "keterangan"
    ];

    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function penjualan_detail()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function pembayaran_piutang()
    {
    	return $this->hasMany(PembayaranPiutang::class)->withTrashed();
    }

    public function retur_penjualan()
    {
        return $this->hasOne(ReturPenjualan::class);
    }
}
