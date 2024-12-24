@extends('doctor.layout')
@section('title', 'Edit Periksa')
@section('content')
    {{-- Form update profile dokter --}}
    <div class="bg-gray-200 shadow-md rounded-lg py-6 px-12 mb-6 mt-3">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Data Periksa</h2>
        <p class="text-sm text-gray-600 mb-6">Isi informasi di bawah ini untuk mengubah data.</p>

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
        <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Poli ID Hidden -->
            <input type="hidden" name="daftar_poli_id" value="{{ $periksa->daftar_poli_id }}">

            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $periksa->tanggal }}">
            </div>

            <!-- Obat-->
            {{-- Looping --}}
            <div>
                <label for="obat_id" class="block text-sm font-medium text-gray-700">Obat</label>
                <select name="obat_id" id="obat_id"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach ($periksa->detailPeriksa as $detail)
                        <option value="{{ $detail->obat->id }}" amount="{{ $detail->obat->harga }}" selected>
                            {{ $detail->obat->nama_obat }} - {{ 'RP. ' . $detail->obat->harga }}
                        </option>
                    @endforeach
                    @foreach ($obats as $obat)
                        <option value="{{ $obat->id }}" amount="{{ $obat->harga }}"> {{ $obat->nama_obat }}-
                            {{ 'RP. ' . $obat->harga }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan -->
            <div>
                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $periksa->catatan }}</textarea>
            </div>

            <!-- Biaya -->
            <div>
                <label for="biaya" class="block text-sm font-medium text-gray-700">Biaya</label>
                <input type="number" name="biaya" id="biaya" readonly
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $periksa->biaya }}">
            </div>

            <!-- Button -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
            </button>

        </form>
        <script>
            // Elemen input
            const obat = document.getElementById('obat_id');
            const biaya = document.getElementById('biaya');

            // Event listener untuk perubahan pada select obat
            obat.addEventListener('change', function() {
                // Ambil atribut "amount" dari opsi yang dipilih
                const selectedOption = obat.selectedOptions[0];
                const hargaObat = parseInt(selectedOption.getAttribute('amount')) || 0;

                // Hitung biaya
                biaya.value = 200000 + hargaObat;
            });
        </script>
    </div>
@endsection
