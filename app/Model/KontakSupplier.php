<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KontakSupplier extends Model
{
	protected $table = 'kontak_supplier';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'supplier_id'
    ];

    public function supplier()
    {
    	return $this->belongsTo(Supplier::class);
    }
}
