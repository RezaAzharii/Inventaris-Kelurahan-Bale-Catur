@php
    $peminjam = $peminjam ?? [];
    $asets = $asets ?? [];

    $peminjaman = $peminjaman ?? (object) [
        'id_peminjaman'   => null,
        'id_peminjam'     => '',
        'id_aset'         => '',
        'jumlah'          => 1,
        'tanggal_pinjam'  => now(),
        'tanggal_kembali' => '',
        'status'          => 'Dipinjam',
    ];

    $is_create = is_null($peminjaman->id_peminjaman);
@endphp

<div class="flex flex-col gap-4">

    <!-- PEMINJAM -->
    <div>
        <label class="block text-sm font-medium mb-1">Peminjam</label>
        <select name="id_peminjam" required class="w-full border rounded px-3 py-2">
            <option value="">-- Pilih Peminjam --</option>
            @foreach ($peminjam as $p)
                <option value="{{ $p->id_peminjam }}"
                    {{ $peminjaman->id_peminjam == $p->id_peminjam ? 'selected' : '' }}>
                    {{ $p->nama_peminjam }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- ASET -->
    <div>
        <label class="block text-sm font-medium mb-1">Aset</label>
        <select name="id_aset" class="id_aset w-full border rounded px-3 py-2">
            <option value="">-- Pilih Aset --</option>

            @foreach ($asets as $aset)
                @php
                    $dipinjam = \App\Models\Peminjaman::where('id_aset', $aset->id_aset)
                        ->where('status', 'Dipinjam')
                        ->sum('jumlah');

                    $jumlahLama = (!$is_create && $peminjaman->id_aset == $aset->id_aset)
                        ? $peminjaman->jumlah
                        : 0;

                    $tersedia = max(0, $aset->jumlah - $dipinjam);
                    $maxInput = $tersedia + $jumlahLama;
                @endphp

                <option value="{{ $aset->id_aset }}"
                        data-max="{{ $maxInput }}"
                        {{ $peminjaman->id_aset == $aset->id_aset ? 'selected' : '' }}>
                    {{ $aset->identitas_barang }} (tersedia {{ $maxInput }})
                </option>
            @endforeach
        </select>
    </div>

    <!-- JUMLAH -->
    <div>
        <label class="block text-sm font-medium mb-1">Jumlah</label>
        <input type="number"
        name="jumlah"
        class="jumlah w-full border rounded px-3 py-2"
        min="1"
        inputmode="numeric"
        value="{{ $peminjaman->jumlah }}"
        required>

    </div>

    <!-- TANGGAL -->
    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Pinjam</label>
        <input type="datetime-local"
            name="tanggal_pinjam"
            value="{{ old('tanggal_pinjam',
                    $peminjaman->tanggal_pinjam
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d\TH:i')
                        : ''
            ) }}"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Kembali</label>
        <input type="datetime-local"
            name="tanggal_kembali"
            value="{{ old('tanggal_kembali',
                    $peminjaman->tanggal_kembali
                        ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('Y-m-d\TH:i')
                        : ''
            ) }}"
            class="w-full border rounded px-3 py-2">
    </div>

    <!-- STATUS -->
    <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2">
            <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.id_aset').forEach((asetSelect, index) => {
        const jumlahInput = document.querySelectorAll('.jumlah')[index];
        let alerted = false;

        function getMax() {
            const opt = asetSelect.options[asetSelect.selectedIndex];
            return opt && opt.dataset.max
                ? Number(opt.dataset.max)
                : null;
        }

        function forceJumlah() {
            const max = getMax();
            if (max === null) return;

            let val = Number(jumlahInput.value);

            if (!val || val < 1) {
                jumlahInput.value = 0;
                alerted = false;
                return;
            }

            if (val > max) {
                jumlahInput.value = max;

                if (!alerted) {
                    alert('⚠️ Jumlah melebihi stok. Maksimal peminjaman ' + max + ' unit.');
                    alerted = true;
                }
            } else {
                alerted = false;
            }
        }

        asetSelect.addEventListener('change', () => {
            alerted = false;
            forceJumlah();
        });

        jumlahInput.addEventListener('input', forceJumlah);

        // validasi awal (EDIT MODE)
        setTimeout(forceJumlah, 50);
    });

});
</script>
