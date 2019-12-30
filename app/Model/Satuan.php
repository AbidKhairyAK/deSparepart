<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Satuan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'satuan';

    protected $fillable = ['nama'];
}
