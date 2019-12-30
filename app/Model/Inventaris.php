<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Inventaris extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "inventaris";

    protected $fillable = [
    	'tanggal', 'barang_id', 'penjualan_detail_id', 'pembelian_detail_id', 'trx_qty', 'trx_harga', 'trx_total'
    ];

    public function inventaris_detail()
    {
    	return $this->hasMany(InventarisDetail::class);
    }

    public function barang()
    {
    	return $this->belongsTo(Barang::class);
    }

    public function penjualan_detail()
    {
    	return $this->belongsTo(PenjualanDetail::class);
    }

    public function pembelian_detail()
    {
    	return $this->belongsTo(PembelianDetail::class);
    }
}
