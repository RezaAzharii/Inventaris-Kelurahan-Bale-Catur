<div class="flex flex-col gap-6">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Barang</label>
            <input type="text" name="jenis_barang" value="{{ old('jenis_barang', $item->jenis_barang ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
            <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Identitas Barang</label>
            <input type="text" name="identitas_barang"
                value="{{ old('identitas_barang', $item->identitas_barang ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pengguna Barang</label>
            <input type="text" name="pengguna_barang"
                value="{{ old('pengguna_barang', $item->pengguna_barang ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Perolehan</label>
            <input type="date" name="tahun_perolehan"
                value="{{ old('tahun_perolehan', $item->tahun_perolehan ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Perolehan</label>
            <input type="number" name="nilai_perolehan"
                value="{{ old('nilai_perolehan', $item->nilai_perolehan ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Saat ini(Rp)</label>
            <input type="number" name="nilai_saat_ini" value="{{ old('nilai_saat_ini', $item->nilai_saat_ini ?? '') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea name="keterangan" rows="3"
                class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
        </div>
    </div>
</div>
