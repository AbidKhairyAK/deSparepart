<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
	protected $table = 'pelanggan';

    protected $fillable = [
    	'id', 'kode', 'nama', 'toko', 'alamat', 'kategori', 'status', 'user_id'
    ];

    public function kontak_pelanggan()
    {
    	return $this->hasMany(KontakPelanggan::class);
    }

    public function penjualan()
    {
    	return $this->hasMany(Penjualan::class);
    }
}
