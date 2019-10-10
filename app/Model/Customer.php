<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customer';

    protected $fillable = [
    	'id', 'kode', 'nama', 'toko', 'alamat', 'kategori', 'status', 'user_id'
    ];

    public function kontak_customer()
    {
    	return $this->hasMany(KontakCustomer::class);
    }

    public function penjualan()
    {
    	return $this->hasMany(Penjualan::class);
    }
}
