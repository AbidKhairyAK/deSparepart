<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ReturPembelian extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'retur_pembelian';

    protected $fillable = [
        'id', "user_id", "pembelian_id", "no_retur", "dikurangi", "dikembalikan", "pembayaran",
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class)->withTrashed();
    }

    public function retur_pembelian_detail()
    {
        return $this->hasMany(ReturPembelianDetail::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
