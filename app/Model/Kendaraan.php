<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
	protected $table = 'kendaraan';

    protected $fillable = [
    	'id', 'merk', 'tipe', 'pabrikan', 'user_id'
    ];
}
