<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	protected $table = 'supplier';

    protected $fillable = [
    	'id', 'kode', 'perusahaan', 'pemilik', 'cp', 'alamat', 'npwp', 'pkp', 'kategori', 'status', 'tempo_kredit', 'user_id', 
    ];

    public function barang()
    {
    	return $this->belongsToMany(Barang::class);
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function kontak_supplier()
    {
    	return $this->hasMany(KontakSupplier::class);
    }
}
