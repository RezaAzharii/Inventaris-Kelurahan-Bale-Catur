@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Peminjam</h2>

    <form action="{{ route('peminjam.store') }}" method="POST">
        @csrf

        <!-- NIK -->
        <label class="block mt-2 font-semibold">NIK</label>
        <input type="text" name="nik" class="w-full border p-2 rounded" required>

        <!-- Nama -->
        <label class="block mt-2 font-semibold">Nama </label>
        <input type="text" name="nama_peminjam" class="w-full border p-2 rounded" required>


        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection
