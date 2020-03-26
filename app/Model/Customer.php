<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'customer';

    protected $fillable = [
        'id', 'kode', 'nama', 'toko', 'alamat', 'kategori', 'status', 'user_id',
    ];

    public function kontak_customer()
    {
        return $this->hasMany(KontakCustomer::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class)->withTrashed();
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
