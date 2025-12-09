@php
    $peminjam = $peminjam ?? [];
    $asets = $asets ?? [];
@endphp

<div class="flex flex-col gap-4">

    <!-- Peminjam -->
    <div>
        <label class="block text-sm font-medium mb-1">Peminjam</label>
        <select name="id_peminjam" required class="w-full px-4 py-2 border rounded">
            <option value="">-- Pilih Peminjam --</option>
            @foreach($peminjam as $p)
                <option value="{{ $p->id_peminjam }}" {{ old('id_peminjam') == $p->id_peminjam ? 'selected' : '' }}>
                    {{ $p->nama_peminjam }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Aset -->
    <div>
        <label class="block text-sm font-medium mb-1">Aset</label>
        <select name="id_aset" required class="w-full px-4 py-2 border rounded">
            <option value="">-- Pilih Aset --</option>
            @foreach($asets as $aset)
                <option value="{{ $aset->id_aset }}" {{ old('id_aset') == $aset->id_aset ? 'selected' : '' }}>
                    {{ $aset->jenis_barang }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Jumlah -->
    <div>
        <label class="block text-sm font-medium mb-1">Jumlah</label>
        <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}" class="w-full px-4 py-2 border rounded" required>
    </div>

    <!-- Tanggal Pinjam -->
    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" class="w-full px-4 py-2 border rounded" required>
    </div>

    <!-- Tanggal Kembali -->
    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" class="w-full px-4 py-2 border rounded" required>
    </div>

    <!-- Status -->
    <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="status" required class="w-full px-4 py-2 border rounded">
            <option value="Dipinjam" {{ old('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="Dikembalikan" {{ old('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
    </div>

</div>
