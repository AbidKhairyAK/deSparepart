<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
	protected $table = 'pemasok';

    protected $fillable = [
    	'id', 'kode', 'perusahaan', 'pemilik', 'cp', 'alamat', 'npwp', 'pkp', 'kategori', 'status', 'user_id'
    ];

    public function barang()
    {
    	return $this->belongsToMany(Barang::class);
    }
}
