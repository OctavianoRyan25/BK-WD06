<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $dokters = Dokter::count();
        $obats = Obat::count();
        $pasiens = Pasien::count();
        return view('admin.dashboard', compact('dokters', 'obats', 'pasiens'));
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] == 'admin' && $credentials['password'] == 'admin') {
            Alert::toast('Welcome Admin', 'success');
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }
}
