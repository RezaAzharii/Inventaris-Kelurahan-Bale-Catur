@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-3">
        <h2 class="text-2xl font-bold text-gray-700">Daftar Peminjam</h2>
    </div>

    <!-- Search + Tombol -->
    <div class="mb-5 flex flex-col md:flex-row items-center justify-between gap-3">

    <!-- Search bar -->
    <form action="{{ route('peminjam.index') }}" method="GET" class="relative w-full">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </span>

            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Cari peminjam..."
                class="w-full border border-gray-300 rounded-md pl-10 pr-10 py-2 text-sm 
                        focus:outline-none focus:ring-1 focus:ring-blue-500">

            @if (request('search'))
                <a href="{{ route('peminjam.index') }}"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                    ✖
                </a>
            @endif
        </div>
    </form>

    <!-- Tombol Tambah -->
    <a href="{{ route('peminjam.create') }}"
    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium shadow-sm transition whitespace-nowrap">
    Tambah Peminjam
    </a>
    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-center font-semibold">ID</th>
                        <th class="px-6 py-3 text-center font-semibold">NIK</th>
                        <th class="px-6 py-3 text-center font-semibold">Nama</th>
                        <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @forelse ($peminjams as $pm)

                    <tr class="hover:bg-blue-50 transition-colors cursor-pointer"
                        onclick="window.location='{{ route('peminjam.show', $pm->id_peminjam) }}'">

                        <td class="px-6 py-3 text-center">{{ $pm->id_peminjam }}</td>
                        <td class="px-6 py-3 text-center">{{ $pm->nik }}</td>
                        <td class="px-6 py-3 text-center">{{ $pm->nama_peminjam }}</td>

                        <td class="px-6 py-3 text-center">

                            <div class="flex justify-center gap-3">

                                <!-- Edit Icon -->
                                <a href="{{ route('peminjam.edit', $pm->id_peminjam) }}"
                                   onclick="event.stopPropagation();"
                                   title="Edit"
                                   class="text-yellow-600 hover:text-yellow-800">
                                    ✏️
                                </a>

                                <!-- Delete Icon -->
                                <form action="{{ route('peminjam.destroy', $pm->id_peminjam) }}"
                                      method="POST"
                                      onclick="event.stopPropagation(); return confirm('Hapus peminjam ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800" title="Hapus">🗑️</button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">
                            Tidak ada peminjam ditemukan.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
