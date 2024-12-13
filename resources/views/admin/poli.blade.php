@extends('admin.layout')
@section('title', 'Poliklinik - Poli')
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
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Poli</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="container mx-auto w-full px-4 py-8">
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-bold text-3xl">Poli</h1>
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


        {{-- Create Poli Button --}}
        <div class="w-full md:w-fit flex justify-between md:items-center gap-4 my-3 mt-3">
            <button id="addUser"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg inline-flex transition duration-200"
                onclick="openModal()">
                Tambah Poli
            </button>
        </div>

        {{-- Table Poli --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#003d7a]">
                    <tr>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">No</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Keterangan
                        </th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-white uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($polis->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4">No data available</td>
                        </tr>
                    @else
                        @foreach ($polis as $index => $poli)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="py-2 px-3 text-center">{{ $polis->firstItem() + $index }}</td>
                                <td class="py-2 px-3 text-center">{{ $poli->nama_poli }}</td>
                                <td class="py-2 px-3 text-center">{{ $poli->keterangan }}</td>
                                <td class="py-2 px-3 text-center">
                                    {{-- Update --}}
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-blue-600 updateEvent transition duration-300 hover:scale-110"
                                            onclick="openReadModal({{ $poli->id }}, '{{ $poli->nama_poli }}', '{{ $poli->keterangan }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-eye-fill h-5 w-5" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </button>
                                        <button class="text-blue-600 updateEvent transition duration-300 hover:scale-110"
                                            onclick="openUpdateModal({{ $poli->id }}, '{{ $poli->nama_poli }}', '{{ $poli->keterangan }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-pencil-square h-5 w-5" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('admin.poli.delete', $poli->id) }}" method="POST"
                                            class="inline-block transition duration-300 hover:scale-110">
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
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Link pagination --}}
        <div class="mt-4">
            {{ $polis->links() }}
        </div>

        <!-- Modal -->
        <div id="createObatModal"
            class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
            <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                id="createPesertaContent">
                <h2 class="text-xl font-bold mb-4 text-start">Tambah Poli</h2>
                <hr class="bg-black mb-2" />
                <form id="pesertaForm" action="{{ route('admin.poli.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap">
                        <div class="mb-6 px-3 w-full lg:w-1/2">
                            <label for="nama_poli" class="block text-sm font-medium text-gray-700">Nama Poli</label>
                            <input type="text" name="nama_poli" id="nama_poli"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                            <p class="text-red-500 text-sm mt-2 error" id="error-nama_poli"></p>
                        </div>

                        <div class="mb-6 px-3 w-full lg:w-1/2">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan"
                                class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                required>
                            <p class="text-red-500 text-sm mt-2 error" id="error-keterangan"></p>
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

        @if ($polis->isNotEmpty())
            {{-- Modal update --}}
            <div id="updateObatModal"
                class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                    id="updatePesertaContent">
                    <h2 class="text-xl font-bold mb-4 text-start">Update Poli</h2>
                    <hr class="bg-black mb-2" />
                    <form id="obatForm" action="{{ route('admin.poli.handleupdate', $poli->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id">
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="nama_poli" class="block text-sm font-medium text-gray-700">Nama Poli</label>
                                <input id="updateNamaPoli" type="text" name="nama_poli" id="nama_poli"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                <p class="text-red-500 text-sm mt-2 error" id="error-nama_obat"></p>
                            </div>

                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input id="updateKeterangan" type="text" name="keterangan" id="keterangan"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required>
                                <p class="text-red-500 text-sm mt-2 error" id="error-keterangan"></p>
                            </div>
                        </div>

                    </form>
                    <div class="flex justify-between gap-6 mt-6 px-3">
                        <button onclick="closePartialModal('updateObatModal')"
                            class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                        <button id="submitModalUpdateBtn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded"
                            onclick="submitUpdateForm()">Submit</button>
                    </div>
                </div>
            </div>
        @endif

        @if ($polis->isNotEmpty())
            {{-- Modal read --}}
            <div id="readPoliModal"
                class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition-all duration-300 scale-90 opacity-0 w-full sm:w-3/4 lg:w-6/12"
                    id="readPoliContent">
                    <h2 class="text-xl font-bold mb-4 text-start">Detail Poli</h2>
                    <hr class="bg-black mb-2" />
                    <form id="poliForm">
                        <input type="hidden" name="id" id="id">
                        <div class="flex flex-wrap">
                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="nama_poli" class="block text-sm font-medium text-gray-700">Nama Poli</label>
                                <input id="readNamaPoli" type="text" name="nama_poli" id="nama_poli"
                                    class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-nama_obat"></p>
                            </div>

                            <div class="mb-6 px-3 w-full lg:w-1/2">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input id="readKeterangan" type="text" name="keterangan" id="keterangan"
                                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    required disabled>
                                <p class="text-red-500 text-sm mt-2 error" id="error-keterangan"></p>
                            </div>
                        </div>

                    </form>
                    <div class="flex justify-between gap-6 mt-6 px-3">
                        <button onclick="closePartialModal('readPoliModal')"
                            class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                        <button id="submitModalUpdateBtn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded"
                            onclick="submitUpdateForm()">Submit</button>
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
        function openReadModal(id, nama_poli, keterangan) {
            const modal = document.getElementById('readPoliModal');
            const modalContent = document.getElementById('readPoliContent');

            document.getElementById('id').value = id;
            document.getElementById('readNamaPoli').value = nama_poli;
            document.getElementById('readKeterangan').value = keterangan;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
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

            document.querySelectorAll('.error').forEach(error => error.innerText = '');

            submitButton.innerText = 'Loading...';
            submitButton.disabled = true;

            const formData = new FormData(form);

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
                    } else {
                        console.log(errorData);
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

        function openUpdateModal(id, nama_poli, keterangan) {
            const modal = document.getElementById('updateObatModal');
            const modalContent = document.getElementById('updatePesertaContent');

            // Set value to form
            document.getElementById('id').value = id;
            document.getElementById('updateNamaPoli').value = nama_poli;
            document.getElementById('updateKeterangan').value = keterangan;

            modal.classList.remove('hidden'); // Show modal
            setTimeout(() => {
                modalContent.classList.remove('scale-90', 'opacity-0'); // Add transition effect
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10); // Delay to trigger transition
        }

        function submitUpdateForm() {
            const form = document.getElementById('obatForm');
            const submitButton = document.getElementById('submitModalUpdateBtn');
            const id = document.getElementById('id').value;

            // Clear previous errors
            document.querySelectorAll('.error').forEach(error => error.innerText = '');

            // Show loading state
            submitButton.innerText = 'Loading...';
            submitButton.disabled = true;

            // Create form data
            const formData = new FormData(form);

            const updateRoute = `/admin/poli/update/${id}`;

            // Send data to server
            fetch(updateRoute, {
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
                    submitButton.innerText = 'Loading...';
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
