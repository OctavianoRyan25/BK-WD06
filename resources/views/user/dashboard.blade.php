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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                    <button onclick="openModal()"
                        class="bg-blue-500 text-white font-bold p-2 rounded-lg hover:scale-105 transition duration-200">
                        Daftar
                    </button>
                </div>
            </div>
            {{-- Riwayat periksa card --}}
            <div class="flex bg-white p-6 rounded-lg shadow border-t-4 border-green-600">
                <div class="flex items-center justify-center w-14 h-14 bg-green-200 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-clock-history h-10 text-green-500" viewBox="0 0 16 16">
                        <path
                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                        <path
                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                    </svg>
                </div>
                <div class="grow h-14 ms-3 flex items-center">
                    <p class="text-gray-600 font-bold">Lihat riwayat periksa</p>
                </div>
                <div class="flex-none w-14 h-14 flex items-center justify-center">
                    <button onclick="toggleModal()"
                        class="bg-green-500 text-white font-bold p-2 rounded-lg hover:scale-105 transition duration-200">
                        Lihat
                    </button>
                </div>
            </div>

            {{-- Tabel histori pemeriksaan --}}
            <div class="row mb-6">
                <div class="col-md-12">
                    <h1 class="font-bold text-3xl">Histori Pemeriksaan</h1>
                    <table class="table-auto w-full border-collapse border border-gray-300 rounded">
                        <thead>
                            <tr class="bg-green-700 text-white">
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Dokter</th>
                                <th class="border border-gray-300 px-4 py-2">Poli</th>
                                <th class="border border-gray-300 px-4 py-2">Jadwal</th>
                                <th class="border border-gray-300 px-4 py-2">Keluhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarPolis as $daftarPoli)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $daftarPoli->jadwalPeriksa->dokter->nama }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $daftarPoli->jadwalPeriksa->dokter->poli->nama_poli }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $daftarPoli->jadwalPeriksa->hari }}, {{ $daftarPoli->jadwalPeriksa->jam_mulai }}
                                        -
                                        {{ $daftarPoli->jadwalPeriksa->jam_selesai }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $daftarPoli->keluhan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="6">Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal --}}
            <div id="riwayatPeriksaModal"
                class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">

                <!-- Overlay -->
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal-container bg-white w-full md:max-w-4xl lg:max-w-5xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <!-- Add modal content here -->
                    <div class="modal-content py-4 text-left px-6">
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Riwayat Periksa</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path d="M1.39 1.393l15.318 15.314m-15.318 0L16.706 1.393" />
                                </svg>
                            </div>
                        </div>
                        <table class="table-auto w-full border-collapse border border-gray-300 rounded">
                            <thead>
                                <tr class="bg-green-700 text-white">
                                    <th class="border border-gray-300 px-4 py-2">No</th>
                                    <th class="border border-gray-300 px-4 py-2">Dokter</th>
                                    <th class="border border-gray-300 px-4 py-2">Tanggal Periksa</th>
                                    <th class="border border-gray-300 px-4 py-2">Obat</th>
                                    <th class="border border-gray-300 px-4 py-2">Catatan</th>
                                    <th class="border border-gray-300 px-4 py-2">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatPeriksas as $riwayatPeriksa)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $riwayatPeriksa->periksa->daftarPoli->jadwalPeriksa->dokter->nama }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ \Carbon\Carbon::parse($riwayatPeriksa->periksa->tanggal)->format('d/m/Y') }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $riwayatPeriksa->obat->nama_obat }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $riwayatPeriksa->periksa->catatan }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">Rp.
                                            {{ number_format($riwayatPeriksa->periksa->biaya, 0, ',', '.') }}
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-center" colspan="6">Tidak ada
                                            data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-4 flex justify-end">
                            <button
                                class="modal-close px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-600 transition duration-200 hover:scale-105"
                                onclick="toggleModal()">Close</button>

                        </div>
                    </div>
                </div>

            </div>


            {{-- Modal --}}
            <div id="daftarModal"
                class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                    id="createPesertaContent">
                    <h2 class="text-xl font-bold mb-4 text-start">Tambah Jadwal Periksa</h2>
                    <hr class="bg-black mb-2" />
                    <form id="pesertaForm" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full">
                                <label for="pasien_id" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                                <input type="hidden" name="pasien_id" id="pasien_id"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required value="{{ auth()->guard('pasien')->user()->id }}" readonly>
                                <input type="text" name="nama_dokter" id="dnama_dokter"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required value="{{ auth()->guard('pasien')->user()->nama }}" disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-pasien_id"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="poli" class="block text-sm font-medium text-gray-700">Pilih poli</label>
                                <select name="poli" id="poli"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required>
                                    <option value="">--Pilih Poli--</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                    @endforeach
                                </select>
                                <p class="text-red-500 text-sm mt-2 error" id="error-hari"></p>
                            </div>
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="jadwal" class="block text-sm font-medium text-gray-700">Pilih Jadwal</label>
                                <select name="jadwal_periksa_id" id="jadwal"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required>
                                    <option value="" disabled>Pilih Jadwal</option>
                                </select>
                                <p class="text-red-500 text-sm mt-2 error" id="error-hari"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full">
                                <label for="keluhan" class="block text-sm font-medium text-gray-700">keluhan</label>
                                <textarea name="keluhan" id="keluhan"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required></textarea>
                                <p class="text-red-500 text-sm mt-2 error" id="error-keluhan"></p>
                            </div>
                        </div>

                    </form>
                    <div class="flex justify-between gap-6 mt-6 px-3">
                        <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                        <button id="submitModalBtn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded"
                            onclick="submitForm()">Submit</button>
                    </div>
                </div>
            </div>

        </div>

        <script>
            function openModal() {
                const modal = document.getElementById('daftarModal');
                const modalContent = document.getElementById('createPesertaContent');

                modal.classList.remove('hidden'); // Show modal
                setTimeout(() => {
                    modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10); // Delay to trigger transition
            }

            function closeModal() {
                const modal = document.getElementById('daftarModal');
                const modalContent = document.getElementById('createPesertaContent');

                modalContent.classList.add('scale-90', 'opacity-0'); // Start hiding transition
                modalContent.classList.remove('scale-100', 'opacity-100');

                setTimeout(() => {
                    modal.classList.add('hidden'); // Hide modal after transition ends
                }, 300); // Match the duration of the transition
            }

            function submitForm() {
                const form = document.getElementById('pesertaForm');
                form.submit();
            }

            function openPoliModal() {
                const modal = document.getElementById('daftarPoliModal');
                const modalContent = document.getElementById('createPesertaContent');

                modal.classList.remove('hidden'); // Show modal
                setTimeout(() => {
                    modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10); // Delay to trigger transition
            }

            function toggleModal() {
                const modal = document.getElementById('riwayatPeriksaModal');

                if (modal.classList.contains('hidden')) {
                    // Open the modal
                    modal.classList.remove('hidden', 'opacity-0');
                    modal.classList.add('opacity-100');
                    setTimeout(() => {
                        modal.classList.remove('scale-90');
                        modal.classList.add('scale-100');
                    }, 300); // Delay to trigger transition
                } else {
                    // Close the modal
                    modal.classList.remove('opacity-100');
                    modal.classList.add('opacity-0');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300); // Duration matches the transition
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Event ketika poli dipilih
                $('#poli').on('change', function() {
                    const poliId = $(this).val();
                    const jadwalDropdown = $('#jadwal');

                    // Kosongkan dropdown jadwal
                    jadwalDropdown.empty();
                    jadwalDropdown.append('<option value="" disabled selected>Loading...</option>');

                    // Fetch jadwal berdasarkan poli
                    if (poliId) {
                        $.ajax({
                            url: `/user/get-jadwal-by-poli/${poliId}`,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Reset dropdown jadwal
                                jadwalDropdown.empty();
                                jadwalDropdown.append(
                                    '<option value="" disabled selected>Pilih Jadwal</option>');
                                data.length === 0 && jadwalDropdown.append(
                                    '<option value="" disabled>Tidak Ada Jadwal</option>');

                                // Populate jadwal
                                data.forEach(function(jadwal) {
                                    const dokterName = jadwal.dokter.nama ??
                                        'Tidak Diketahui';
                                    jadwalDropdown.append(
                                        `<option value="${jadwal.id}">
                                ${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai} (Dr.  ${dokterName})
                            </option>`
                                    );
                                });
                            },
                            error: function() {
                                jadwalDropdown.empty();
                                jadwalDropdown.append(
                                    '<option value="" disabled>Gagal Memuat Jadwal</option>');
                            }
                        });
                    } else {
                        jadwalDropdown.append(
                            '<option value="" disabled selected>Pilih Poli Terlebih Dahulu</option>');
                    }
                });
            });
        </script>
    @endsection
