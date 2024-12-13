<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
