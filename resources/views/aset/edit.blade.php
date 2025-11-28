@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">Edit Data Aset</h1>

        <form action="{{ route('aset.update', $aset->id_aset) }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Jenis Barang</label>
                    <input type="text" name="jenis_barang" value="{{ old('jenis_barang', $aset->jenis_barang) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kode Barang</label>
                    <input type="text" name="kode_barang" value="{{ old('kode_barang', $aset->kode_barang) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Identitas Barang</label>
                    <input type="text" name="identitas_barang"
                        value="{{ old('identitas_barang', $aset->identitas_barang) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Pengguna Barang</label>
                    <input type="text" name="pengguna_barang"
                        value="{{ old('pengguna_barang', $aset->pengguna_barang) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tahun Perolehan</label>
                    <input type="date" name="tahun_perolehan"
                        value="{{ old('tahun_perolehan', $aset->tahun_perolehan) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nilai Saat Ini</label>
                    <input type="number" name="nilai_saat_ini" value="{{ old('nilai_saat_ini', $aset->nilai_saat_ini) }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Keterangan</label>
                    <textarea name="keterangan" class="w-full border border-gray-300 rounded-lg p-2" rows="3">{{ old('keterangan', $aset->keterangan) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('aset.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
@endsection
