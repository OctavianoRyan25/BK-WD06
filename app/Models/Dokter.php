<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Authenticatable
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'dokter_id');
    }
}
