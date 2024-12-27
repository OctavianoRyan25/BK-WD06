<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
{
    public function index()
    {
        $id = auth()->guard('dokter')->user()->id;
        $jadwals = JadwalPeriksa::where('dokter_id', $id)->count();
        $periksas = Periksa::with('daftarPoli.jadwalPeriksa')->whereHas('daftarPoli.jadwalPeriksa', function ($query) {
            $query->where('dokter_id', auth()->guard('dokter')->user()->id);
        })->count();
        $dokter = Dokter::with('poli')->find($id);
        return view('doctor.dashboard', compact('jadwals', 'periksas', 'dokter'));
    }

    public function profile($id)
    {
        $dokter = Dokter::with('poli')->find($id);
        $polis = Poli::all();
        return view('doctor.edit_profile', compact('dokter', 'polis'));
    }

    public function updateProfile(Request $request)
    {
        $id = auth()->guard('dokter')->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        try {
            $dokter = Dokter::find($id);
            $dokter->nama = $request->nama;
            $dokter->alamat = $request->alamat;
            $dokter->no_hp = $request->no_hp;
            $dokter->save();
            Alert::toast('Profile berhasil diupdate', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Profile gagal diupdate', 'error');
            return route('dokter.dashboard');
        }
    }
}
