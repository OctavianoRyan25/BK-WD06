<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'periksa_id',
        'obat_id',
        'biaya',
    ];

    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'periksa_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
