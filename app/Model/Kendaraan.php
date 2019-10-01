<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
	protected $table = 'kendaraan';

    protected $fillable = [
    	'id', 'merk', 'tipe', 'pabrikan', 'user_id'
    ];
}
