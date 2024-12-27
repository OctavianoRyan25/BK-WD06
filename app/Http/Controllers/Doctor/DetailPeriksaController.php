<?php

namespace App\Http\Controllers\Doctor;

use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien;

class DetailPeriksaController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::paginate(10);
        $detailPeriksas = DetailPeriksa::with([
            'periksa.daftarPoli.jadwalPeriksa',
            'obat'
        ])->whereHas('periksa.daftarPoli.jadwalPeriksa', function ($query) {
            $query->where('dokter_id', auth('dokter')->user()->id);
        })->paginate(10);
        return view('doctor.detail_periksa', compact('detailPeriksas', 'pasiens'));
    }

    public function show()
    {
        $pasienId = request()->get('pasien_id');
        $dokterId = request()->get('dokter_id');
        $detailPeriksas = DetailPeriksa::with([
            'periksa.daftarPoli.jadwalPeriksa',
            'obat'
        ])->whereHas('periksa.daftarPoli.jadwalPeriksa', function ($query) use ($pasienId, $dokterId) {
            $query->where('pasien_id', $pasienId);
            $query->where('dokter_id', $dokterId);
        })->get();
        // return response()->json($detailPeriksas);
        return view('doctor.show_detail_periksa', compact('detailPeriksas'));
    }
}
