<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	protected $table = 'barang';

    protected $fillable = [
    	'id', 'user_id', 'komponen_id', 'kendaraan_id', 'part_no', 'nama', 'merk', 'stok', 'limit', 'satuan_id', 'harga_beli', 'harga_jual', 'keterangan', 'gambar'
    ];

    protected $with = ['user', 'komponen', 'satuan', 'kendaraan', 'pembelian_detail'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class);
    }

    public function satuan()
    {
    	return $this->belongsTo(Satuan::class);
    }

    public function kendaraan()
    {
    	return $this->belongsTo(Kendaraan::class);
    }

    public function pembelian_detail()
    {
        return $this->hasMany(PembelianDetail::class);
    }

    public function setHargaBeliAttribute($value)
    {
        $this->attributes['harga_beli'] = str_replace(".", "", $value);
    }

    public function setHargaJualAttribute($value)
    {
        $this->attributes['harga_jual'] = str_replace(".", "", $value);
    }
}
