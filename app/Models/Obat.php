<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'obat_id');
    }
}
