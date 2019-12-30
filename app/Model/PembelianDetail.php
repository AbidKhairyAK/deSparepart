<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PembelianDetail extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'pembelian_detail';

    protected $fillable = [
    	'id', "pembelian_id", "barang_id", "part_no", "nama", "satuan", "qty", "stok", "harga", "harga_asli", "subtotal", "diskon", "ppn"
	];

    public function pembelian()
    {
    	return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
    	return $this->belongsTo(Barang::class);
    }
}
