<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Kendaraan extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'kendaraan';

    protected $fillable = [
    	'id', 'merk', 'tipe', 'pabrikan', 'user_id'
    ];
}
