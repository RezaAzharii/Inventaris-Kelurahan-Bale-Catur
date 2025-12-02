@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Peminjam</h2>


<form action="{{ route('peminjam.update', $peminjam->id_peminjam) }}" method="POST">
    @csrf
    @method('PUT')

    <label class="block mt-2">NIK</label>
    <input type="text" name="nik" class="w-full border p-2 rounded"
           value="{{ $peminjam->nik }}" required>

    <label class="block mt-2">Nama</label>
    <input type="text" name="nama_peminjam" class="w-full border p-2 rounded"
           value="{{ $peminjam->nama_peminjam }}" required>

    <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">Perbarui</button>
</form>


</div>
@endsection

