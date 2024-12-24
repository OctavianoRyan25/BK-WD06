<?php

namespace App\Http\Controllers\Doctor;

use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailPeriksaController extends Controller
{
    public function index()
    {
        $detailPeriksas = DetailPeriksa::with([
            'periksa.daftarPoli.jadwalPeriksa',
            'obat'
        ])->whereHas('periksa.daftarPoli.jadwalPeriksa', function ($query) {
            $query->where('dokter_id', auth('dokter')->user()->id);
        })->paginate(10);
        return view('doctor.detail_periksa', compact('detailPeriksas'));
    }

    public function show($id)
    {
        $detailPeriksa = DetailPeriksa::with([
            'periksa.daftarPoli.jadwalPeriksa',
            'obat'
        ])->where('id', $id)->first();
        return view('doctor.detail_periksa_show', compact('detailPeriksa'));
    }
}
