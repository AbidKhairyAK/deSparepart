<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class KontakCustomer extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'kontak_customer';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'customer_id'
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
