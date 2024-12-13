<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::paginate(10);
        return view(
            'admin.obat',
            [
                'obats' => $obats
            ]
        );
    }

    public function show($id)
    {
        $obat = Obat::findOrFail($id);
        return response()->json($obat, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Obat::create($validateData);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data obat berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Data obat gagal ditambahkan'
            ], 500);
        }
    }

    public function handleupdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Obat::where('id', $id)->update($validateData);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data obat berhasil diubah'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Data obat gagal diubah'
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $obat = Obat::find($id);
            if (!$obat) {
                Alert::error('Error', 'Data obat tidak ditemukan');
                return redirect()->back();
            }
            $obat->delete();
            DB::commit();
            Alert::toast('Data obat berhasil dihapus', 'success');
            return redirect()->to(url()->previous());
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Data obat gagal dihapus', 'error');
            return redirect()->back();
        }
    }
}
