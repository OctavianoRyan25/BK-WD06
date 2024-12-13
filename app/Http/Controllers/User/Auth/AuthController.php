<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('user.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->only('nama', 'alamat');

        $user = Pasien::where('nama', $credentials['nama'])
            ->where('alamat', $credentials['alamat'])
            ->first();

        if ($user) {
            auth()->guard('pasien')->login($user);
            Alert::toast('You have been logged in', 'success');
            return redirect()->route('user.dashboard');
        }
        Alert::toast('Invalid credentials', 'error');
        return back()->with('error', 'Invalid credentials');
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function handleRegister(Request $request)
    {
        $credentials = $request->validate([
            'nama' => 'required',
            'no_ktp' => 'required|unique:pasiens',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        try {
            $pasien = Pasien::latest()->first();
            if (!$pasien) {
                $pasien = new Pasien();
                $pasien->id = 0;
            }
            $pasien->id += 1;
            // no_rm adalaha tahun bulan no urut ex 202411-001 dst
            $credentials['no_rm'] = date('Ym') . '-' . str_pad($pasien->id, 3, '0', STR_PAD_LEFT);
            Pasien::create($credentials);
        } catch (\Exception $e) {
            Alert::toast('Failed to create account', 'error');
            Log::error($e->getMessage());
            return back()->route('user.login');
        }

        Alert::toast('Succes to create account', 'success');
        return view('user.auth.login');
    }

    public function logout()
    {
        auth()->guard('pasien')->logout();

        Alert::toast('You have been logged out', 'success');
        return view('user.auth.login');
    }

    public function forgotPassword()
    {
        return view('user.auth.forgot-password');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Alert::toast('No user found with that email', 'error');
            return back()->with('error', 'No user found with that email');
        }

        $user->sendPasswordResetNotification($user->createToken('password-reset'));

        Alert::toast('Password reset email sent', 'success');
        return redirect()->back()->with('success', 'Password reset email sent');
    }
}
