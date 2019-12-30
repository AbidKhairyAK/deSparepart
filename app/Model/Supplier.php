<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Supplier extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
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
