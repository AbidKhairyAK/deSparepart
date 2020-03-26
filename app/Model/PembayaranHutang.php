<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PembayaranHutang extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pembayaran_hutang';

    protected $fillable = [
        'id', "pembelian_id", "user_id", "no_pelunasan", "hutang", "dibayarkan", "pembayaran", "pembayaran_detail", "sisa", "status_lunas",
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class)->withTrashed();
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
