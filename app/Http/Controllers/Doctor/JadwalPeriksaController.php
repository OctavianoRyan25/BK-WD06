<?php

namespace App\Http\Controllers\Doctor;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('dokter_id', auth()->guard('dokter')->user()->id)->paginate(10);
        return view('doctor.jadwal_periksa', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|string'
        ]);

        foreach (JadwalPeriksa::where('dokter_id', $request->dokter_id)->get() as $jadwal) {
            if ($jadwal->hari === $request->hari) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jadwal periksa sudah ada'
                ], 400);
            }
        }

        if ($request->status === 'Aktif') {
            $activeJadwalPeriksa = JadwalPeriksa::where('dokter_id', $request->dokter_id)
                ->where('status', 'Aktif')
                ->first();

            if ($activeJadwalPeriksa) {
                $activeJadwalPeriksa->update([
                    'status' => 'Tidak Aktif'
                ]);
            }
        }

        JadwalPeriksa::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal periksa berhasil ditambahkan'
        ], 201);
    }

    public function edit(JadwalPeriksa $jadwalPeriksa)
    {
        return view('doctor.jadwal-periksa.edit', compact('jadwalPeriksa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status' => 'required|string'
        ]);

        if ($request->status === 'Aktif') {
            $activeJadwalPeriksa = JadwalPeriksa::where('dokter_id', $request->dokter_id)
                ->where('status', 'Aktif')
                ->first();

            if ($activeJadwalPeriksa) {
                $activeJadwalPeriksa->update([
                    'status' => 'Tidak Aktif'
                ]);
            }
        }

        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal periksa berhasil diubah'
        ]);
    }

    public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        Alert::toast('Jadwal periksa berhasil dihapus', 'success');
        return redirect()->route('dokter.jadwal-periksa');
    }
}
