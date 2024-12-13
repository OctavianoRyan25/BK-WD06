<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poli')->paginate(10);
        return view(
            'admin.dokter',
            [
                'dokters' => $dokters,
                'polis' => Poli::all(),
            ]
        );
    }

    public function show($id)
    {
        $dokter = Dokter::with('poli')->findOrFail($id);
        return view(
            'admin.show_dokter',
            [
                'dokter' => $dokter,
            ]
        );
    }

    public function create()
    {
        return view(
            'admin.create_dokter',
            [
                'polis' => Poli::all(),
            ]
        );
    }

    public function tambah()
    {
        return view(
            'user.auth.register',
            [
                'polis' => Poli::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Dokter::create($validated);
            DB::commit();
            Alert::toast('Berhasil menambahkan dokter', 'success');
            return response()->json([
                'status' => 'success',
                'message' => 'Data dokter berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            Alert::toast('Gagal menambahkan dokter', 'error');
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Data dokter gagal ditambahkan'
            ], 500);
        }
    }

    public function edit($id)
    {
        $dokter = Dokter::find($id);
        return view(
            'admin.edit_dokter',
            [
                'dokter' => $dokter,
                'polis' => Poli::all(),
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Dokter::find($id)->update($validated);
            DB::commit();
            Alert::toast('Berhasil mengubah dokter', 'success');
            return redirect()->route('admin.dokter');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah dokter', 'error');
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Dokter::find($id)->delete();
            DB::commit();
            Alert::toast('Berhasil menghapus dokter', 'success');
            return redirect()->route('admin.dokter');
        } catch (\Exception $e) {
            Alert::toast('Gagal menghapus dokter', 'error');
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
