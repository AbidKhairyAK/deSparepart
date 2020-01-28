<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
