@extends('doctor.layout')
@section('title', 'Poliklinik - Show Detail Periksa')
@section('content')
    {{-- Looping in table data detailPeriksas --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-gray-100 py-6 px-8 mb-6 mt-3">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Detail Periksa</h2>
        <table class="w-full text-sm text-left text-gray-500  border-collapse">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                <tr>
                    <th scope="col" class="px-6 py-4">No</th>
                    <th scope="col" class="px-6 py-4">Tanggal Periksa</th>
                    <th scope="col" class="px-6 py-4">Obat</th>
                    <th scope="col" class="px-6 py-4">Catatan</th>
                    <th scope="col" class="px-6 py-4">Biaya</th>
                    <th scope="col" class="px-6 py-4">Nama Pasien</th>
                </tr>
            </thead>
            <tbody>
                @if ($detailPeriksas->isEmpty())
                    <tr>
                        <td colspan="12" class="text-center px-6 py-4 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-ban-fill text-red-500" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M2.71 12.584q.328.378.706.707l9.875-9.875a7 7 0 0 0-.707-.707l-9.875 9.875Z" />
                                </svg>
                                <span class="mt-2 text-lg font-medium text-gray-500">Data tidak ditemukan</span>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($detailPeriksas as $detailPeriksa)
                        <tr class="odd:bg-white even:bg-gray-50  border-b  hover:bg-gray-100 ">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($detailPeriksa->periksa->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">{{ $detailPeriksa->obat->nama_obat }}</td>
                            <td class="px-6 py-4">{{ $detailPeriksa->periksa->catatan }}</td>
                            <td class="px-6 py-4">Rp. {{ number_format($detailPeriksa->periksa->biaya, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $detailPeriksa->periksa->daftarPoli->pasien->nama }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
