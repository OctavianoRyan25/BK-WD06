<?php

namespace App\Http\Controllers\Doctor;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class PeriksaController extends Controller
{
    public function index()
    {
        $auth = auth('dokter')->user()->id;
        $daftarPolis = DaftarPoli::with([
            'pasien',
            'jadwalPeriksa',
            'periksa.detailPeriksa.obat'
        ])
            ->whereHas('jadwalPeriksa', function ($query) use ($auth) {
                $query->where('dokter_id', $auth);
            })
            ->get();
        $obats = Obat::all();
        // return response()->json(['daftarPolis' => $daftarPolis, 'obats' => $obats]);
        return view('doctor.periksa', compact('daftarPolis', 'obats'));
    }

    public function find($id)
    {
        $daftarPoli = $id;
        $obats = Obat::all();
        $daftarPolis = DaftarPoli::with([
            'pasien',
            'jadwalPeriksa',
            'periksa.detailPeriksa.obat'
        ])
            ->where('id', $id)
            ->first();
        // return response()->json(['daftarPolis' => $daftarPolis, 'daftarPoli' => $daftarPoli]);
        return view(
            'doctor.periksa_pasien',
            [
                'daftar_poli_id' => $daftarPoli,
                'daftarPolis' => $daftarPolis,
                'obats' => $obats
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'daftar_poli_id' => 'required|exists:daftar_polis,id',
            'tanggal' => 'required|date',
            'catatan' => 'required',
            'biaya' => 'required|integer',
            'obat_id' => 'required|exists:obats,id'
        ]);

        try {
            $periksa = Periksa::create($request->all());
            DetailPeriksa::create([
                'periksa_id' => $periksa->id,
                'obat_id' => $request->obat_id,
            ]);

            Alert::toast('Periksa berhasil ditambahkan', 'success');
            return redirect()->route('dokter.periksa');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Alert::toast($e->getMessage(), 'error');
            return redirect()->back()->with('error', 'Periksa gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $periksa = Periksa::with('daftarPoli', 'detailPeriksa', 'detailPeriksa.obat')->find($id);
        $obats = Obat::all();
        return view('doctor.edit_periksa', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'daftar_poli_id' => 'required|exists:daftar_polis,id',
            'tanggal' => 'required|date',
            'catatan' => 'required',
            'biaya' => 'required|integer',
            'obat_id' => 'required|exists:obats,id'
        ]);

        try {
            $periksa = Periksa::find($id);
            $periksa->update($request->all());
            $periksa->detailPeriksa()->update([
                'obat_id' => $request->obat_id,
            ]);

            Alert::toast('Periksa berhasil diubah', 'success');
            return redirect()->route('dokter.periksa');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Alert::toast($e->getMessage(), 'error');
            return redirect()->back()->with('error', 'Periksa gagal diubah');
        }
    }
}
