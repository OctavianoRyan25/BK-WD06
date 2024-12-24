@extends('doctor.layout')
@section('title', 'Periksa Pasien')
@section('content')
    <div class="bg-gray-200 shadow-md rounded-lg py-6 px-12 mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Periksa Pasien</h2>
        <p class="text-sm text-gray-600 mb-6">Isi informasi di bawah ini untuk melanjutkan pemeriksaan pasien.</p>

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
        <form id="obatForm" action="{{ route('dokter.periksa.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Hidden input for ID -->
            <input type="hidden" name="id" id="id">

            <!-- Daftar Poli ID Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Daftar Poli ID -->
                <div class="hidden">
                    <label for="daftar_poli_id" class="block text-sm font-medium text-gray-700">Daftar Poli ID</label>
                    <input type="hidden" name="daftar_poli_id" id="updateDokterId"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $daftar_poli_id }}" readonly>
                </div>

                <!-- Nama Pasien -->
                <div>
                    <label for="nama_dokter" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="nama_dokter" id="updateNamaDokter"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $daftarPolis->pasien->nama }}" disabled>
                </div>

                <!-- Tanggal Periksa -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Periksa</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- catatan -->
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" id="catatan" rows="3"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>

                <!-- Obat -->
                <div>
                    <label for="obat" class="block text-sm font-medium text-gray-700">Obat</label>
                    <select name="obat_id" id="obat"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Obat</option>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat . ' - Rp. ' . $obat->harga }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Total biaya --}}
                <div>
                    <label for="total_biaya" class="block text-sm font-medium text-gray-700">Total Biaya</label>
                    <input readonly id="total_biaya" name="biaya" type="number"
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        Simpan
                    </button>
                </div>
        </form>
    </div>

    <script>
        // Get the total biaya
        const obat = document.getElementById('obat');
        const totalBiaya = document.getElementById('total_biaya');

        obat.addEventListener('change', function() {
            const selectedObat = obat.options[obat.selectedIndex];
            // Ambil harga dari teks opsi
            const hargaText = selectedObat.text.split(' - ')[1]?.replace(/[^\d]/g, ''); // Hapus huruf non-angka
            const harga = parseInt(hargaText) || 0; // Pastikan harga adalah angka, jika tidak gunakan 0

            // total biaya = harga obat + 200000
            const total = 200000 + harga;

            // Tampilkan hasil
            totalBiaya.value = total;
            console.log(`Harga: ${harga}, Total Biaya: ${total}`);
        });
    </script>

@endsection
