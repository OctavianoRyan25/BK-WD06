@extends('doctor.layout')
@section('title', 'Poliklinik - Periksa')
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
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Jadwal Periksa</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="container mx-auto w-full px-4 py-8">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-bold text-3xl">Periksa</h1>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Table Event --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#003d7a]">
                    <tr>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Nama
                            Pasien</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Jam
                            Periksa
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">No Antrian
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Status
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Keluhan
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($daftarPolis->isEmpty())
                        <tr>
                            <td colspan="12" class="text-center py-4 font-bold">No data available</td>
                        </tr>
                    @else
                        @foreach ($daftarPolis as $index => $daftarPoli)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                {{-- <td class="py-2 px-3 text-center">{{ $daftarPolis->id }}</td> --}}
                                <td class="py-2 px-3 text-center">{{ $daftarPoli->pasien->nama }}</td>
                                <td class="py-2 px-3 text-center">
                                    {{ $daftarPoli->jadwalPeriksa->hari . ' ' . $daftarPoli->jadwalPeriksa->jam_mulai . '-' . $daftarPoli->jadwalPeriksa->jam_selesai }}
                                </td>
                                <td class="py-2 px-3 text-center">{{ $daftarPoli->no_antrian }}</td>
                                @if (!$daftarPoli->periksa)
                                    <td class="py-2 px-3 text-center"><span
                                            class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Belum
                                            Diperiksa</span>
                                    </td>
                                @else
                                    <td class="py-2 px-3 text-center"><span
                                            class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Sudah
                                            Diperiksa</span>
                                    </td>
                                @endif
                                <td class="py-2 px-3 text-center">{{ $daftarPoli->keluhan }}</td>
                                <td class="py-2 px-3 text-center gap-2">
                                    <div class="flex justify-center space-x-2">
                                        @if (!$daftarPoli->periksa)
                                            <a class="text-blue-600 updateEvent transition duration-300 hover:scale-110"
                                                href="{{ route('dokter.periksa.find', $daftarPoli->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                    class="bi bi-bandaid-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="m2.68 7.676 6.49-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492.001-.002Zm5.71-2.858a.5.5 0 1 0-.708.707.5.5 0 0 0 .707-.707ZM6.974 6.939a.5.5 0 1 0-.707-.707.5.5 0 0 0 .707.707M5.56 8.354a.5.5 0 1 0-.707-.708.5.5 0 0 0 .707.708m2.828 2.828a.5.5 0 1 0-.707-.707.5.5 0 0 0 .707.707m1.414-2.121a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707m1.414-.707a.5.5 0 1 0-.706-.708.5.5 0 0 0 .707.708Zm-4.242.707a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707m1.414-.707a.5.5 0 1 0-.707-.708.5.5 0 0 0 .707.708m1.414-2.122a.5.5 0 1 0-.707.707.5.5 0 0 0 .707-.707M8.646 3.354l4 4 .708-.708-4-4zm-1.292 9.292-4-4-.708.708 4 4z" />
                                                </svg>
                                            </a>
                                        @else
                                            <a class="text-yellow-600 updateEvent transition duration-300 hover:scale-110"
                                                href="{{ route('dokter.periksa.edit', $daftarPoli->periksa->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                        @endif
                                        {{-- <form action="{{ route('dokter.jadwal-periksa.delete', $daftarPoli->id) }}"
                                            method="POST" class="inline-block transition duration-300 hover:scale-110">
                                            @csrf
                                            @method('DELETE')
                                            <button id="buttonDeleteEvent" onclick="confirmDelete(event)" type="button"
                                                class="text-red-600 deleteEvent">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>

        {{-- Link pagination --}}
        {{-- <div class="mt-4">
            {{ $daftarPolis->links() }}
        </div> --}}

        <!-- Modal -->
        <div id="createObatModal"
            class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                id="createPesertaContent">
                <h2 class="text-xl font-bold mb-4 text-start">Tambah Jadwal Periksa</h2>
                <hr class="bg-black mb-2" />
                <form id="pesertaForm" action="{{ route('dokter.jadwal-periksa.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap">
                        <div class="mb-6 px-3 w-full lg:w-1/2">
                            <label for="dokter_id" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                            <input type="hidden" name="dokter_id" id="dokter_id"
                                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required value="{{ auth()->guard('dokter')->user()->id }}" readonly>
                            <input type="text" name="nama_dokter" id="dnama_dokter"
                                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required value="{{ auth()->guard('dokter')->user()->nama }}" disabled>
                            <p class="text-red-500 text-sm mt-2 error" id="error-dokter_id"></p>
                        </div>

                        <div class="mb-6 px-3 w-full lg:w-1/2">
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select name="hari" id="hari"
                                class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                required>
                                <option value="" disabled>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                            <p class="text-red-500 text-sm mt-2 error" id="error-hari"></p>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="mb-6 px-3 w-full lg:w-1/3">
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai"
                                class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                required>
                            <p class="text-red-500 text-sm mt-2 error" id="error-jam_mulai"></p>
                        </div>
                        <div class="mb-6 px-3 w-full lg:w-1/3">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai"
                                class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                required>
                            <p class="text-red-500 text-sm mt-2 error" id="error-jam_selesai"></p>
                        </div>
                        <div class="mb-6 px-3 w-full lg:w-1/3">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                required>
                                <option value="" disabled>Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            <p class="text-red-500 text-sm mt-2 error" id="error-status"></p>
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

        {{-- Modal read --}}
        @if ($daftarPolis->isNotEmpty())
            <div id="readJadwalModal"
                class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                    id="readPesertaContent">
                    <h2 class="text-xl font-bold mb-4 text-start">Detail Jadwal</h2>
                    <hr class="bg-black mb-2" />
                    <form id="obatForm" action="">
                        <input type="hidden" name="id" id="id">
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="nama_dokter" class="block text-sm font-medium text-gray-700">Nama
                                    Dokter</label>
                                <input id="readNamaDokter" type="text" name="nama_dokter" id="nama_dokter"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-nama_dokter"></p>
                            </div>

                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                <input id="readHari" type="text" name="hari" id="hari"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-hari"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input id="readJamMulai" type="text" name="jam_mulai" id="jam_mulai"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-jam_mulai"></p>
                            </div>
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam
                                    Selesai</label>
                                <input id="readJamSelesai" type="text" name="jam_selesai" id="jam_selesai"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-jam_selesai"></p>
                            </div>
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <input id="readStatus" type="text" name="status" id="status"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-status"></p>
                            </div>
                        </div>

                    </form>
                    <div class="flex justify-between gap-6 mt-6 px-3">
                        <button onclick="closePartialModal('readJadwalModal')"
                            class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                    </div>
                </div>
            </div>
        @endif

        <style>
            .loader {
                border-radius: 50%;
                width: 32px;
                height: 32px;
                border-top-color: transparent;
                border-right-color: transparent;
            }
        </style>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript -->
    <script>
        function openReadModal(id, nama_dokter, hari, jam_mulai, jam_selesai, status) {
            const modal = document.getElementById('readJadwalModal');
            const modalContent = document.getElementById('readPesertaContent');
            // property
            document.getElementById('id').value = id;
            document.getElementById('readNamaDokter').value = nama_dokter;
            document.getElementById('readHari').value = hari;
            document.getElementById('readJamMulai').value = jam_mulai;
            document.getElementById('readJamSelesai').value = jam_selesai;
            document.getElementById('readStatus').value = status;

            // Set value to form
            document.getElementById('id').value = id;


            modal.classList.remove('hidden'); // Show modal
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10); // Delay to trigger transition
        }

        function openModal() {
            const modal = document.getElementById('createObatModal');
            const modalContent = document.getElementById('createPesertaContent');

            modal.classList.remove('hidden'); // Show modal
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10); // Delay to trigger transition
        }

        function closeModal() {
            const modal = document.getElementById('createObatModal');
            const modalContent = document.getElementById('createPesertaContent');

            modalContent.classList.add('scale-90', 'opacity-0'); // Start hiding transition
            modalContent.classList.remove('scale-100', 'opacity-100');

            setTimeout(() => {
                modal.classList.add('hidden'); // Hide modal after transition ends
            }, 300); // Match the duration of the transition
        }

        function submitForm() {
            const form = document.getElementById('pesertaForm');
            const submitButton = document.getElementById('submitModalBtn');

            // Clear previous errors
            document.querySelectorAll('.error').forEach(error => error.innerText = '');

            // Show loading state
            submitButton.innerText = 'Loading...';
            submitButton.disabled = true;

            // Create form data
            const formData = new FormData(form);

            // Send data to server
            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw data
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).fire({
                            icon: 'success',
                            title: data.message
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    }
                })
                .catch(errorData => {
                    if (errorData.errors) {
                        Object.keys(errorData.errors).forEach(key => {
                            const errorElement = document.getElementById(`error-${key}`);
                            if (errorElement) errorElement.innerText = errorData.errors[key][0];
                        });
                        submitButton.innerText = 'Submit';
                    } else {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).fire({
                            icon: 'error',
                            title: errorData.message || 'An error occurred. Please try again.'
                        });
                    }
                })
                .finally(() => {
                    submitButton.innerText = 'Submit';
                    submitButton.disabled = false;
                });
        }

        // Close Modal
        function closePartialModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form agar tidak submit secara langsung
            const form = event.target.closest('form'); // Temukan form terdekat
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = form.querySelector('button[type="button"]');
                    const deleteButton = form.querySelector('#buttonDeleteEvent');
                    // const spinner = form.querySelector('#spinner');
                    button.disabled = true; // Nonaktifkan tombol
                    deleteButton.classList.add('hidden'); // Sembunyikan icon delete
                    // spinner.classList.remove('hidden'); // Tampilkan spinner
                    form.submit(); // Kirim form setelah konfirmasi
                }
            });
        }

        function openUpdateModal(id, id_dokter, nama_dokter, hari, jam_mulai, jam_selesai, status) {
            const modal = document.getElementById('updateJadwalModal');
            const modalContent = document.getElementById('updatePesertaContent');

            // Set value to form
            document.getElementById('id').value = id;
            document.getElementById('updateDokterId').value = id_dokter;
            document.getElementById('updateNamaDokter').value = nama_dokter;
            document.getElementById('updateHari').value = hari;
            document.getElementById('updateJamMulai').value = jam_mulai;
            document.getElementById('updateJamSelesai').value = jam_selesai;
            document.getElementById('updateStatus').value = status;

            modal.classList.remove('hidden'); // Show modal
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10); // Delay to trigger transition
        }

        function submitUpdateForm() {
            const form = document.getElementById('obatForm');
            const submitButton = document.getElementById('submitModalUpdateBtn');
            const id = document.getElementById('id').value; // Ambil ID dari hidden input

            // Clear previous errors
            document.querySelectorAll('.error').forEach(error => error.innerText = '');

            // Show loading state
            submitButton.innerText = 'Loading...';
            submitButton.disabled = true;

            // Create form data
            const formData = new FormData(form);

            // Route dinamis berdasarkan ID
            const updateRoute = `/dokter/jadwal-periksa/update/${id}`;

            // Send data to server
            fetch(updateRoute, {
                    method: 'POST', // Ganti dengan 'PUT' jika diperlukan
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw data;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        }).fire({
                            icon: 'success',
                            title: data.message
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    }
                })
                .catch(errorData => {
                    if (errorData.errors) {
                        Object.keys(errorData.errors).forEach(key => {
                            const errorElement = document.getElementById(`error-${key}`);
                            if (errorElement) errorElement.innerText = errorData.errors[key][0];
                        });
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        }).fire({
                            icon: 'error',
                            title: 'Semua field harus diisi'
                        });
                    } else {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        }).fire({
                            icon: 'error',
                            title: errorData.message || 'An error occurred. Please try again.'
                        });
                    }
                })
                .finally(() => {
                    submitButton.innerText = 'Submit';
                    submitButton.disabled = false;
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
