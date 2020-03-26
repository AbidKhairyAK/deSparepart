<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Komponen extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'komponen';

    protected $fillable = [
        'id', 'nama', 'tipe', 'bagian', 'user_id', 'kode',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
