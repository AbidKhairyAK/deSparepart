<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InventarisDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "inventaris_detail";

    protected $fillable = [
    	'tanggal', 'inventaris_id', 'inv_qty', 'inv_stok', 'inv_harga', 'inv_total'
    ];

    public function inventaris()
    {
    	return $this->belongsTo(Inventaris::class);
    }
}
