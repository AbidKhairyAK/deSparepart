<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'audits';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
