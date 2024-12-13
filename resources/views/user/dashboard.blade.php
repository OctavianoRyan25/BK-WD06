@extends('user.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="container mx-auto w-full px-4 py-8">
        <div class="row mb-6">
            <div class="col-md-12">
                <h1 class="font-bold text-3xl">Dashboard</h1>
            </div>
        </div>

        <!-- Stats and User Info Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- User Info -->
            <div class="bg-white p-6 rounded-lg shadow flex justify-between items-center border-t-4 border-yellow-600">
                <div class="flex items-center gap-4">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center">
                        <img src="{{ asset('assets/profile.png') }}" alt="User" class="h-8 w-8">
                    </div>
                    <div>
                        <h3 class="font-semibold">Welcome</h3>
                        <p class="text-gray-600">{{ Auth::guard('pasien')->user()->nama }}</p>
                    </div>
                </div>
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="border text-white font-bold bg-red-600 p-2 rounded-lg hover:scale-105 transition duration-200">Sign
                        out</button>
                </form>
            </div>
            <div class="bg-white p-6 rounded-lg shadow flex justify-between items-center border-t-4 border-orange-600">
                <img src="{{ asset('assets/logo-udinus.png') }}" alt="Logo Udinus" class="h-12 w-12">
                <h2 class="font-bold text-blue-800">Poliklinik AP for Bengkel Coding</h2>
                <p class="text-sm font-semibold">v1.0</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Revenue Card -->
            <div class="flex bg-white p-6 rounded-lg shadow border-t-4 border-red-600">
                <div class="flex items-center justify-center w-14 h-14 bg-blue-200 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 text-blue-700" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1zM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25zM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25z" />
                        <path
                            d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1zm2 14h2v-3H7zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1zm0-14H6v1h4zm2 7v7h3V8zm-8 7V8H1v7z" />
                    </svg>
                </div>
                <div class="grow h-14 ms-3 flex items-center">
                    <p class="text-gray-600 font-bold">Silahkan daftar disini</p>
                </div>
                <div class="flex-none w-14 h-14 flex items-center justify-center">
                    <a href="{{ route('user.register') }}"
                        class="bg-blue-500 text-white font-bold p-2 rounded-lg hover:scale-105 transition duration-200">
                        Daftar
                    </a>
                </div>
            </div>

            <!-- New Customers Card -->
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-green-600">
                <h3 class="text-gray-600">Total Kerja Sama</h3>
                <p class="text-2xl font-bold">1.34k</p>
            </div>
            <!-- New Orders Card -->
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-600">
                <h3 class="text-gray-600">Total Research Collaboration</h3>
                <p class="text-2xl font-bold">123</p>
            </div>
        </div>
    </div>
@endsection
