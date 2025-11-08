@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <!-- Modal Tambah Aset -->
        <x-modal-forms id="asetModal" title="Tambah Aset Baru" :action="route('aset.store')" fieldsView="aset.create"
            buttonText="Simpan Data" />

        <!-- Header dan Form -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold text-gray-700">
                Daftar Aset Perusahaan
            </h1>

            @if (session('success'))
                <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <!-- Seaech section -->
        <div class="flex flex-col md:flex-row gap-2 items-center mb-6 w-full">
            <form action="{{ route('aset.index') }}" method="GET" class="relative flex-1">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </span>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari aset (kode, jenis, identitas)..."
                        class="w-full border border-gray-300 rounded-md pl-10 pr-10 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @if (request('search'))
                        <a href="{{ route('aset.index') }}"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                            title="Reset pencarian">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif

                    <!-- Tombol Submit -->
                    {{-- <button type="submit"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-blue-600 hover:text-blue-800"
                    title="Cari aset">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </button> --}}
                </div>
            </form>

            <button onclick="openModal('asetModal')"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium shadow-sm transition">
                Tambah Aset
            </button>
        </div>

        <!-- Tabel Aset -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">No</th>
                            <th class="px-6 py-3 text-left font-semibold">Jenis Barang</th>
                            <th class="px-6 py-3 text-left font-semibold">Kode</th>
                            <th class="px-6 py-3 text-left font-semibold">Identitas</th>
                            <th class="px-6 py-3 text-left font-semibold">Pengguna</th>
                            <th class="px-6 py-3 text-left font-semibold">Tahun</th>
                            <th class="px-6 py-3 text-left font-semibold">Nilai Perolehan</th>
                            <th class="px-6 py-3 text-left font-semibold">Nilai Saat Ini</th>
                            <th class="px-6 py-3 text-left font-semibold">QR Code</th>
                            <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($asets as $index => $aset)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-3">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 font-medium text-gray-800">{{ $aset->jenis_barang }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $aset->kode_barang }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $aset->identitas_barang }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $aset->pengguna_barang }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ $aset->tahun_perolehan }}</td>
                                <td class="px-6 py-3 text-gray-600">
                                    Rp{{ number_format($aset->nilai_perolehan, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3 text-gray-600">
                                    Rp{{ number_format($aset->nilai_saat_ini, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3">
                                    <div
                                        class="w-16 h-16 p-1 bg-white border border-gray-200 rounded-sm flex items-center justify-center">
                                        {!! QrCode::size(80)->generate(
                                            json_encode(
                                                [
                                                    'kode' => $aset->kode_barang,
                                                    'identitas' => $aset->identitas_barang,
                                                    'pengguna' => $aset->pengguna_barang,
                                                ],
                                                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE,
                                            ),
                                        ) !!}
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-gray-700">
                                    <div class="flex flex-col items-center gap-3">

                                        <a href="{{ route('aset.edit', $aset->id_aset) }}"
                                            class="text-blue-600 hover:underline"></a><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-square-pen-icon lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path
                                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                        </svg>

                                        <x-alert-dialog :action="route('aset.destroy', $aset->id_aset)" title="Hapus Data Aset?"
                                            message="Aset ini akan dihapus secara permanen dan tidak dapat dikembalikan. Lanjutkan?"
                                            confirmText="Hapus" cancelText="Batal">
                                            <x-slot:trigger>
                                                <button class="text-red-600 hover:underline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-trash2-icon lucide-trash-2">
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </x-slot:trigger>
                                        </x-alert-dialog>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-6 text-gray-500">
                                    Tidak ada data aset ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
