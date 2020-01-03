<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawan";

    protected $fillable = [
        'jabatan_id', 'nama', 'alamat', 'email', 'phone', 'gaji', 'foto'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function setGajiAttribute($value)
    {
        $this->attributes['gaji'] = str_replace(".", "", $value);
    }
}
