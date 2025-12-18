@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Detail Peminjaman
        </h2>
        <a href="{{ route('peminjaman.index') }}"
            class="inline-flex items-center !text-gray-600 hover:text-gray-600 text-sm font-medium !no-underline transition-colors duration-200">
            <span class="mr-1">&larr;</span>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Detail Peminjaman -->
            <div class="space-y-4">
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Peminjaman</h3>
                </div>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Peminjam</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->peminjam->nama_peminjam ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Aset</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->Aset->identitas_barang ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Jumlah</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->jumlah }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Tanggal Pinjam</p>
                        <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Tanggal Kembali</p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        @php $status = strtolower($peminjaman->status); @endphp
                        <span class="px-2 py-1 rounded text-white text-xs
                            @if($status == 'dipinjam') bg-yellow-500
                            @elseif($status == 'dikembalikan') bg-green-600
                            @else bg-gray-500 @endif">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
