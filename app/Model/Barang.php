<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Barang extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'barang';

    protected $fillable = [
        'id', 'user_id', 'komponen_id', 'kendaraan_id', 'kode', 'part_no', 'nama', 'merk', 'stok', 'limit', 'satuan_id', 'harga_beli', 'harga_jual', 'keterangan', 'gambar',
    ];

    protected $with = ['user', 'komponen', 'satuan', 'kendaraan', 'pembelian_detail'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class)->withTrashed();
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class)->withTrashed();
    }

    public function pembelian_detail()
    {
        return $this->hasMany(PembelianDetail::class);
    }

    public function penjualan_detail()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }

    public function setHargaBeliAttribute($value)
    {
        $this->attributes['harga_beli'] = str_replace(".", "", $value);
    }

    public function setHargaJualAttribute($value)
    {
        $this->attributes['harga_jual'] = str_replace(".", "", $value);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
