<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
	protected $table = 'penjualan_detail';

    protected $fillable = [
    	'id', "penjualan_id", "barang_id", "part_no", "nama", "qty", "harga", "subtotal", "diskon"
	];

    public function penjualan()
    {
    	return $this->hasMany(Penjualan::class);
    }

    public function barang()
    {
    	return $this->hasMany(Barang::class);
    }
}
