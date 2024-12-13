<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::paginate(10);
        return view(
            'admin.pasien',
            [
                'pasiens' => $pasiens,
            ]
        );
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.show_pasien', ['pasien' => $pasien]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_ktp' => 'required|unique:pasiens',
        ]);

        try {
            $pasien = Pasien::latest()->first();
            if (!$pasien) {
                $pasien = new Pasien();
                $pasien->id = 0;
            }
            $pasien->id += 1;
            // no_rm adalaha tahun bulan no urut ex 202411-001 dst
            $validated['no_rm'] = date('Ym') . '-' . str_pad($pasien->id, 3, '0', STR_PAD_LEFT);
            DB::beginTransaction();
            Pasien::create($validated);
            DB::commit();
            Alert::toast('Berhasil menambahkan pasien', 'success');
            // return redirect()->route('admin.pasien');
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan pasien'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            // return redirect()->back();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan pasien'
            ], 500);
        }
    }

    public function edit($id)
    {
        $pasien = Pasien::find($id);
        return view('admin.edit_pasien', ['pasien' => $pasien]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_ktp' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Pasien::find($id)->update($validated);
            DB::commit();
            Alert::toast('Berhasil mengubah pasien', 'success');
            return redirect()->route('admin.pasien');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Pasien::find($id)->delete();
            DB::commit();
            Alert::toast('Berhasil menghapus pasien', 'success');
            return redirect()->route('admin.pasien');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
