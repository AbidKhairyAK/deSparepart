<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
	protected $table = 'komponen';

    protected $fillable = [
    	'id', 'nama', 'tipe', 'bagian', 'user_id'
    ];
}
