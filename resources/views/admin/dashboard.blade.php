@extends('admin.layout')
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
                        <p class="text-gray-600">Admin Cihuy</p>
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

            <!-- New Customers Card -->
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-green-600">
                <h3 class="text-gray-600">Total Dokter</h3>
                <p class="text-2xl font-bold">{{ $dokters }}</p>
            </div>
            <!-- New Orders Card -->
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-600">
                <h3 class="text-gray-600">Total Obat</h3>
                <p class="text-2xl font-bold">{{ $obats }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-600">
                <h3 class="text-gray-600">Total Pasien</h3>
                <p class="text-2xl font-bold">{{ $pasiens }}</p>
            </div>
        </div>
    </div>
@endsection
