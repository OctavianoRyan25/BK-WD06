<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::paginate(10);
        return view('admin.poli', [
            'polis' => $polis
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            Poli::create($validated);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Poli added successfully'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Failed to add poli', 'error');
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add poli'
            ], 500);
        }
    }

    public function handleupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_poli' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            Poli::where('id', $id)->update($validated);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Poli updated successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Failed to update poli', 'error');
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update poli'
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Poli::where('id', $id)->delete();
            DB::commit();
            Alert::toast('Poli deleted successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast($e->getMessage(), 'error');
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
