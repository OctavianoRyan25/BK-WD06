<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        $daftarPolis = DaftarPoli::with(['pasien', 'jadwalPeriksa'])->where('pasien_id', auth()->guard('pasien')->user()->id)->get();
        $riwayatPeriksas = DetailPeriksa::with(['periksa.daftarPoli', 'obat'])->whereHas('periksa.daftarPoli', function ($query) {
            $query->where('pasien_id', auth()->guard('pasien')->user()->id);
        })->get();
        // return response()->json([$polis, $daftarPolis, $riwayatPeriksas], 200);
        return view('user.dashboard', compact('polis', 'daftarPolis', 'riwayatPeriksas'));
    }


    public function getJadwalByPoli($id)
    {
        $jadwals = JadwalPeriksa::whereHas('dokter.poli', function ($query) use ($id) {
            $query->where('id', $id);
        })->where('status', 'Aktif')->with(['dokter.poli'])->get();

        return response()->json($jadwals);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'jadwal_periksa_id' => 'required',
            'keluhan' => 'required',
        ]);

        $request['no_antrian'] = JadwalPeriksa::find($request->jadwal_periksa_id)->count() + 1;
        try {
            DaftarPoli::create($request->all());
            Alert::success('Success', 'Data berhasil disimpan');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
