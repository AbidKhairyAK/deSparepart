<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PembayaranPiutang extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pembayaran_piutang';

    protected $fillable = [
        'id', "penjualan_id", "user_id", "no_pelunasan", "piutang", "dibayarkan", "pembayaran", "pembayaran_detail", "sisa", "status_lunas",
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
