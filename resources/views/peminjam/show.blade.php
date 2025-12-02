@extends('layouts.app')

@section('content')
<div class="px-8 py-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Detail Peminjam
        </h2>

        <a href="{{ route('peminjam.index') }}" 
           class="text-sm text-gray-500 hover:text-gray-700 transition">
            ← Kembali ke Daftar
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white shadow rounded-xl p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Informasi -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Informasi Peminjam
                </h3>
                <hr class="mb-5">

                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-gray-500">ID Peminjam</p>
                        <p class="font-medium">{{ $peminjam->id_peminjam }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">NIK</p>
                        <p class="font-medium">{{ $peminjam->nik }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nama</p>
                        <p class="font-medium">{{ $peminjam->nama_peminjam }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
