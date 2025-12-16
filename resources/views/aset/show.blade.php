@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                {{ $aset->identitas_barang }}
            </h2>
            <a href="{{ route('aset.index') }}"
                class="inline-flex items-center !text-gray-600 hover:text-gray-600 text-sm font-medium !no-underline transition-colors duration-200">
                <span class="mr-1">&larr;</span>
                Kembali ke Daftar
            </a>

        </div>

        <div class="bg-gray-50 p-6 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Aset</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="flex w-full justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kode Barang</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->kode_barang }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jumlah</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->jumlah }}</p>
                            </div>
                        </div>
                        <div class="flex w-full justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jenis Barang</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->jenis_barang }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Identitas Barang</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->identitas_barang }}</p>
                            </div>
                        </div>
                        <div class="flex w-full justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pengguna Barang</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->pengguna_barang }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tahun Perolehan</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $aset->tahun_perolehan }}</p>
                            </div>
                        </div>
                        <div class="flex w-full justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nilai Perolehan</p>
                                <p class="mt-1 text-sm text-gray-900">Rp.{{ number_format($aset->nilai_perolehan, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nilai Saat Ini</p>
                                <p class="mt-1 text-sm text-gray-900">Rp.{{ number_format($aset->nilai_saat_ini, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Keterangan</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $aset->keterangan }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-medium text-gray-900">QR Code</h3>
                    </div>

                    <div class="mt-4 flex flex-col items-center">
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div id="qrcode-container">
                                {!! QrCode::size(200)->margin(2)->backgroundColor(255, 255, 255)->color(0, 0, 0)->generate(
                                        json_encode([
                                            'kode' => $aset->kode_barang,
                                            'jenis' => $aset->jenis_barang,
                                            'identitas' => $aset->identitas_barang,
                                        ]),
                                    ) !!}
                            </div>
                        </div>

                        <button onclick="downloadQRCode()"
                            class="mt-4 px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Export QR Code (PNG)
                        </button>
                    </div>
                </div>
            </div>

            <script>
                function downloadQRCode() {
                    const container = document.getElementById('qrcode-container');
                    const svg = container.querySelector('svg');
                    const padding = 20;
                    const canvas = document.createElement('canvas');
                    canvas.width = svg.width.baseVal.value + padding * 2;
                    canvas.height = svg.height.baseVal.value + padding * 2;
                    const ctx = canvas.getContext('2d');

                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    const img = new Image();
                    const svgData = new XMLSerializer().serializeToString(svg);
                    const url = URL.createObjectURL(new Blob([svgData], {
                        type: 'image/svg+xml'
                    }));

                    img.onload = function() {
                        ctx.drawImage(img, padding, padding, svg.width.baseVal.value, svg.height.baseVal.value);
                        URL.revokeObjectURL(url);

                        canvas.toBlob(function(blob) {
                            const link = document.createElement('a');
                            link.download = 'QRCode-{{ $aset->kode_barang }}-{{ now()->format('Ymd') }}.png';
                            link.href = URL.createObjectURL(blob);
                            link.click();
                            URL.revokeObjectURL(link.href);
                        }, 'image/png', 1.0);
                    };

                    img.src = url;
                }
            </script>

            <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        @endsection
