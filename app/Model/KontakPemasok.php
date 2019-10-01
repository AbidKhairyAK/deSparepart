<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KontakPemasok extends Model
{
	protected $table = 'kontak_pemasok';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'pemasok_id'
    ];

    public function pemasok()
    {
    	return $this->belongsTo(Pemasok::class);
    }
}
