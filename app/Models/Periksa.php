<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'daftar_poli_id');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'periksa_id');
    }
}
