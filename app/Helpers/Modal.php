<?php
namespace App\Helpers;
use App\Model\Barang;

class Modal
{
	public static function item()
	{
		$item = Barang::whereColumn('stok','<=','limit')->get();
        if (count($item)) {
            return $item;
        } else {
            return false;
        }
	}
}
