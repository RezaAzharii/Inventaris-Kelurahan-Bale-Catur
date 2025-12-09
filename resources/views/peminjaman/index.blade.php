@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-semibold text-gray-700">
            Daftar Peminjaman Aset
        </h1>

        @if (session('success'))
            <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Search + Tombol Modal -->
    <div class="flex flex-col md:flex-row gap-2 items-center mb-6 w-full">
        <form action="{{ route('peminjaman.index') }}" method="GET" class="relative flex-1">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </span>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari peminjam, aset, tanggal..."
                    class="w-full border border-gray-300 rounded-md pl-10 pr-10 py-2 text-sm 
                    focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">

                @if (request('search'))
                    <a href="{{ route('peminjaman.index') }}"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                        title="Reset pencarian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>

        <!-- Tombol buka modal -->
        <button onclick="openModal('peminjamanModal')"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium shadow-sm transition">
            Tambah Peminjaman
        </button>

        <!-- Komponen Modal -->
        <x-modal-forms 
            id="peminjamanModal" 
            title="Tambah Peminjaman" 
            :action="route('peminjaman.store')" 
            fieldsView="peminjaman.create" 
            :fieldsData="['peminjam' => $peminjam, 'asets' => $asets]" 
            buttonText="Simpan Data"  
        />
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No</th>
                        <th class="px-6 py-3 text-left font-semibold">Peminjam</th>
                        <th class="px-6 py-3 text-left font-semibold">Aset</th>
                        <th class="px-6 py-3 text-left font-semibold">Jumlah</th>
                        <th class="px-6 py-3 text-left font-semibold">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left font-semibold">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($peminjaman as $index => $p)
                        <tr class="hover:bg-blue-50 transition-colors cursor-pointer"
                            onclick="window.location='{{ route('peminjaman.show', $p->id_peminjaman) }}'">

                            <td class="px-6 py-3">{{ $index + 1 }}</td>

                            <td class="px-6 py-3 font-medium text-gray-800">
                                {{ $p->peminjam->nama_peminjam ?? '-' }}
                            </td>

                            <td class="px-6 py-3">
                                {{ $p->Aset->jenis_barang ?? '-' }}
                            </td>

                            <td class="px-6 py-3">{{ $p->jumlah }}</td>

                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}
                            </td>

                            <td class="px-6 py-3">
                                {{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') : '-' }}
                            </td>

                            <td class="px-6 py-3">
                                @php $status = strtolower($p->status); @endphp
                                <span class="px-2 py-1 rounded text-white text-xs
                                    @if($status == 'dipinjam') bg-yellow-500
                                    @elseif($status == 'dikembalikan') bg-green-600
                                    @else bg-gray-500 @endif">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                <div class="flex flex-col items-center gap-3">

                                    <!-- Edit Button -->
                                    <a href="{{ route('peminjaman.edit', $p->id_peminjaman) }}"
                                        onclick="event.stopPropagation()" class="text-blue-600 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-square-pen-icon lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button as Icon -->
                                    <form id="deleteForm-{{ $p->id_peminjaman }}"
                                        action="{{ route('peminjaman.destroy', $p->id_peminjaman) }}"
                                        method="POST"
                                        onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="openDeleteModal({{ $p->id_peminjaman }})"
                                                class="text-red-600 hover:underline cursor-pointer">
                                            
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
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">
                                Tidak ada data peminjaman ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
<div id="modalDelete"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45);
    align-items:center; justify-content:center; z-index:9999;">

    <div style="
        background:#ffffff; 
        padding:25px; 
        border-radius:12px; 
        width:90%; 
        max-width:500px;        /* ❗ Ukuran modal mengikuti modal terbaru */
        box-shadow:0 10px 25px rgba(0,0,0,0.2); 
        animation:fadeIn .15s ease-out;
    ">
        
        <h2 style="font-size:20px; font-weight:700; margin-bottom:12px; color:#333;">
            Hapus Data Peminjaman?
        </h2>

        <p style="color:#555; margin-bottom:22px; line-height:1.45;">
            Data peminjaman akan dihapus permanen dan tidak dapat dikembalikan.  
            Apakah Anda yakin ingin melanjutkan?
        </p>

        <div style="display:flex; justify-content:flex-end; gap:12px;">
            <button onclick="closeDeleteModal()"
                style="padding:8px 18px; background:#e5e7eb; color:#333; 
                border:none; border-radius:6px; cursor:pointer;">
                Batalkan
            </button>

            <button id="confirmDeleteBtn"
                style="padding:8px 18px; background:#e11d48; color:white;
                border:none; border-radius:6px; cursor:pointer;">
                Hapus
            </button>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn { 
    from{opacity:0; transform:scale(.95);} 
    to{opacity:1; transform:scale(1);} 
}
</style>

<script>
    let selectedDeleteId = null;

    function openDeleteModal(id) {
        selectedDeleteId = id;
        document.getElementById('modalDelete').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('modalDelete').style.display = 'none';
        selectedDeleteId = null;
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (selectedDeleteId) {
            document.getElementById(`deleteForm-${selectedDeleteId}`).submit();
        }
    });
</script>
@endsection
