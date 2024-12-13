<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorAuthController extends Controller
{
    public function login()
    {
        return view('doctor.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->only('nama', 'alamat');

        $dokter = Dokter::where('nama', $credentials['nama'])
            ->where('alamat', $credentials['alamat'])
            ->first();

        if ($dokter) {
            auth()->guard('dokter')->login($dokter);
            Alert::toast('You have been logged in', 'success');
            return redirect()->route('dokter.dashboard');
        }
        Alert::toast('Invalid credentials', 'error');
        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        auth()->guard('dokter')->logout();

        Alert::toast('You have been logged out', 'success');
        return view('doctor.auth.login');
    }
}
