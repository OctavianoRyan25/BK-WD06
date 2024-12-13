@extends('admin.layout')
@section('title', 'Poliklinik - Tambah Dokter')
@section('content')
    <nav class="flex container mx-auto w-full px-4 pt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dokter') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Pasien
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Edit Pasien</span>
                </div>
            </li>
        </ol>
    </nav>
    {{-- form create Dokter --}}
    <div class="container w-full">
        <div class="px-6 py-10 bg-white shadow-lg rounded-lg mt-3 mx-3">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Update Data Pasien</h1>
                <p class="text-gray-600 text-sm mt-2">Isi informasi pasien dengan lengkap untuk mengupdate data.</p>
            </div>
            {{-- looping error --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.pasien.handleupdate', $pasien->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700">Nama Pasien</label>
                        <input type="text" name="nama" id="nama" autocomplete="off"
                            placeholder="Masukkan nama pasien" value="{{ $pasien->nama }}"
                            class="mt-2 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm text-sm border-gray-300 rounded-lg py-2 px-3 placeholder-gray-400"
                            required>
                    </div>
                    <div>
                        <label for="no_rm" class="block text-sm font-semibold text-gray-700">No RM</label>
                        <input type="text" name="no_rm" id="no_rm" autocomplete="off"
                            placeholder="Masukkan nomor rekam medis" value="{{ $pasien->no_rm }}"
                            class="mt-2 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm text-sm border-gray-300 rounded-lg py-2 px-3 placeholder-gray-400"
                            required disabled>
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" autocomplete="off" rows="3" placeholder="Masukkan alamat dokter"
                            class="mt-2 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm text-sm border-gray-300 rounded-lg py-2 px-3 placeholder-gray-400 resize-none"
                            required>{{ $pasien->alamat }}</textarea>
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700">Telepon</label>
                        <input type="tel" name="no_hp" id="no_hp" autocomplete="off"
                            placeholder="Masukkan nomor telepon" value="{{ $pasien->no_hp }}"
                            class="mt-2 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm text-sm border-gray-300 rounded-lg py-2 px-3 placeholder-gray-400"
                            required>
                    </div>
                    <div>
                        <label for="no_ktp" class="block text-sm font-semibold text-gray-700">No KTP</label>
                        <input type="text" name="no_ktp" id="no_ktp" autocomplete="off"
                            placeholder="Masukkan nomor KTP" value="{{ $pasien->no_ktp }}"
                            class="mt-2 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm text-sm border-gray-300 rounded-lg py-2 px-3 placeholder-gray-400"
                            required>
                    </div>
                </div>
                <div class="mt-6 flex justify-center">
                    <button type="submit"
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Update Dokter
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
