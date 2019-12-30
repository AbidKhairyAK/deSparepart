<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PenjualanDetail extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'penjualan_detail';

    protected $fillable = [
    	'id', "penjualan_id", "barang_id", "part_no", "satuan", "nama", "qty", "stok", "harga", "harga_asli", "subtotal", "diskon"
	];

    public function penjualan()
    {
    	return $this->belongsTo(Penjualan::class);
    }

    public function barang()
    {
    	return $this->belongsTo(Barang::class);
    }
}
