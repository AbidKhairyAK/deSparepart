<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ReturPenjualan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'retur_penjualan';

    protected $fillable = [
        'id', "user_id", "penjualan_id", "no_retur", "dikurangi", "dikembalikan", "pembayaran",
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class)->withTrashed();
    }

    public function retur_penjualan_detail()
    {
        return $this->hasMany(ReturPenjualanDetail::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
