<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class KontakSupplier extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'kontak_supplier';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'supplier_id'
    ];

    public function supplier()
    {
    	return $this->belongsTo(Supplier::class);
    }
}
