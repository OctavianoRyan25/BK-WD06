@extends('doctor.layout')
@section('title', 'Edit Profile')
@section('content')
    {{-- Form update profile dokter --}}
    <div class="bg-gray-200 shadow-md rounded-lg py-6 px-12 mb-6 mt-3">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Profile</h2>
        <p class="text-sm text-gray-600 mb-6">Isi informasi di bawah ini untuk mengubah data diri Anda.</p>

        {{-- Looping error --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('dokter.profile.update', $dokter->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $dokter->nama }}">
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $dokter->alamat }}">
            </div>

            <!-- No. HP -->
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP</label>
                <input type="text" name="no_hp" id="no_hp"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $dokter->no_hp }}">
            </div>

            <!-- Poli -->
            <div>
                <label for="id_poli" class="block text-sm font-medium text-gray-700">Poli</label>
                <select name="id_poli" id="id_poli"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{ $dokter->poli->id }}" selected> {{ $dokter->poli->nama_poli }}</option>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}"> {{ $poli->nama_poli }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
                </butyon>

        </form>
    </div>
@endsection
