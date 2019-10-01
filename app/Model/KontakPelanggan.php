<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KontakPelanggan extends Model
{
	protected $table = 'kontak_pelanggan';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'pelanggan_id'
    ];

    public function pelanggan()
    {
    	return $this->belongsTo(Pelanggan::class);
    }
}
