@extends('doctor.layout')
@section('title', 'Poliklinik - Detail Periksa')
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

        {{-- Table Pasien --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#003d7a]">
                    <tr>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Nama
                            Pasien</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Alamat
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">No. KTP
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">No.
                            Telepon
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">No. RM
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($pasiens->isEmpty())
                        <tr>
                            <td colspan="12" class="text-center py-4 font-bold">No data available</td>
                        </tr>
                    @else
                        @foreach ($pasiens as $index => $pasien)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="py-2 px-3 text-center">{{ $pasien->nama }}
                                </td>
                                <td class="py-2 px-3 text-center">{{ $pasien->alamat }}</td>
                                <td class="py-2 px-3 text-center">{{ $pasien->no_ktp }}</td>
                                <td class="py-2 px-3 text-center">{{ $pasien->no_hp }}</td>
                                <td class="py-2 px-3 text-center">{{ $pasien->no_rm }}</td>
                                <td class="py-2 px-3 text-center gap-2">
                                    <div class="flex justify-center space-x-2">
                                        <a class="text-blue-600 updateEvent transition duration-300 hover:scale-110"
                                            href="{{ route('dokter.detail-periksa.show', ['pasien_id' => $pasien->id, 'dokter_id' => Auth::guard('dokter')->user()->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                class="bi bi-receipt" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                                <path
                                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $detailPeriksas->links() }}
        </div>


        {{-- Modal read --}}
        {{-- @if ($detailPeriksas->isNotEmpty())
            <div id="readPeriksaModal"
                class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                    id="readPesertaContent">
                    <h2 class="text-xl font-bold mb-4 text-start">Detail Periksa</h2>
                    <hr class="bg-black mb-2" />
                    <form id="periksaForm" action="">
                        <input type="hidden" name="id" id="id">
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="nama_pasien" class="block text-sm font-medium text-gray-700">Nama
                                    Pasien</label>
                                <input id="readPasien" type="text" name="nama_pasien" id="nama_pasien"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-nama_pasien"></p>
                            </div>

                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
                                <input id="readKeluhan" type="text" name="keluhan" id="keluhan"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-keluhan"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="obat" class="block text-sm font-medium text-gray-700">Obat</label>
                                <input id="readObat" type="text" name="obat" id="obat"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-obat"></p>
                            </div>
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal
                                    Periksa</label>
                                <input id="readTanggal" type="text" name="tanggal" id="tanggal"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-tanggal"></p>
                            </div>
                            <div class="mb-6 px-3 w-full lg:w-1/3">
                                <label for="biaya" class="block text-sm font-medium text-gray-700">biaya</label>
                                <input id="readBiaya" type="text" name="biaya" id="biaya"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-biaya"></p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                                <input id="readCatatan" type="text" name="catatan" id="catatan"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-catatan"></p>
                            </div>
                        </div>

                    </form>
                    <div class="flex justify-between gap-6 mt-6 px-3">
                        <button onclick="closePartialModal('readPeriksaModal')"
                            class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                    </div>
                </div>
            </div>
        @endif --}}

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
        function openReadModal(id, nama_pasien, keluhan, catatan, tanggal, biaya, obat) {
            const modal = document.getElementById('readPeriksaModal');
            const modalContent = document.getElementById('readPesertaContent');
            // property
            document.getElementById('id').value = id;
            document.getElementById('readPasien').value = nama_pasien;
            document.getElementById('readKeluhan').value = keluhan;
            document.getElementById('readObat').value = obat;
            document.getElementById('readTanggal').value = tanggal;
            document.getElementById('readBiaya').value = biaya;
            document.getElementById('readCatatan').value = catatan;

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
