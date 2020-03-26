<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Supplier extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'supplier';

    protected $fillable = [
        'id', 'kode', 'perusahaan', 'pemilik', 'cp', 'alamat', 'npwp', 'pkp', 'kategori', 'status', 'tempo_kredit', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class)->withTrashed();
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class)->withTrashed();
    }

    public function kontak_supplier()
    {
        return $this->hasMany(KontakSupplier::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
