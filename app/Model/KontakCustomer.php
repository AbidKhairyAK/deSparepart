<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KontakCustomer extends Model
{
	protected $table = 'kontak_customer';

    protected $fillable = [
    	'id', 'tipe', 'kontak', 'customer_id'
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
