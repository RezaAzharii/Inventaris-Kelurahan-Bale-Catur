@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-6">
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Edit Data Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman->id_peminjaman) }}" method="POST"
        class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Peminjam</label>
                <select name="id_peminjam" class="w-full border border-gray-300 rounded-lg p-2" required>
                    @foreach($peminjam as $p)
                        <option value="{{ $p->id_peminjam }}" {{ $p->id_peminjam == $peminjaman->id_peminjam ? 'selected' : '' }}>
                            {{ $p->nama_peminjam }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Aset</label>
                <select name="id_aset" class="w-full border border-gray-300 rounded-lg p-2" required>
                    @foreach($asets as $aset)
                        <option value="{{ $aset->id_aset }}" {{ $aset->id_aset == $peminjaman->id_aset ? 'selected' : '' }}>
                            {{ $aset->jenis_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Jumlah</label>
                <input type="number" name="jumlah" value="{{ old('jumlah', $peminjaman->jumlah) }}"
                    class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                    class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}"
                    class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg p-2" required>
                    @foreach(['Dipinjam', 'Dikembalikan'] as $status)
                        <option value="{{ strtolower($status) }}" {{ strtolower($status) == $peminjaman->status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('peminjaman.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
