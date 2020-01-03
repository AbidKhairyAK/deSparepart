<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komponen extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    
	protected $table = 'komponen';

    protected $fillable = [
    	'id', 'nama', 'tipe', 'bagian', 'user_id'
    ];
}
