@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col md:flex-row gap-6 p-6">

        <div
            class="w-full md:w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 border-l-4 border-blue-500">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">
                Jumlah Aset
            </h3>
            <p class="text-4xl font-extrabold text-blue-900">
                150
            </p>
            <p class="text-xs text-gray-400 mt-2">
                Total aset saat ini
            </p>
        </div>

        <div
            class="w-full md:w-1/2 p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 border-l-4 border-blue-500">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">
                Jumlah Peminjaman
            </h3>
            <p class="text-4xl font-extrabold text-blue-900">
                250
            </p>
            <p class="text-xs text-gray-400 mt-2">
                Total pinjaman aset saat ini
            </p>
        </div>

    </div>
@endsection
