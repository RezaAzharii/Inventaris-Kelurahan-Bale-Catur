<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Peminjam;
use App\Models\Aset;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'aset']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tanggal_pinjam', 'like', "%{$search}%")
                    ->orWhere('tanggal_kembali', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('peminjam', function ($p) use ($search) {
                        $p->where('nama_peminjam', 'like', "%{$search}%");
                    })
                    ->orWhereHas('aset', function ($a) use ($search) {
                        $a->where('jenis_barang', 'like', "%{$search}%");
                    });
            });
        }

        $peminjaman = $query->get();
        $peminjam = Peminjam::all();
        $asets = Aset::all();

        return view('peminjaman.index', compact('peminjaman', 'peminjam', 'asets'));
    }

    public function create()
    {
        $peminjam = Peminjam::all();
        $asets = Aset::all();

        return view('peminjaman.create', compact('peminjam', 'asets'));
    }



    public function store(Request $request)
    {
        Peminjaman::create($request->only([
            'id_peminjam',
            'id_aset',
            'tanggal_pinjam',
            'tanggal_kembali',
            'status',
            'jumlah'
        ]));

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['peminjam', 'aset'])->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjam = Peminjam::all();
        $asets = Aset::all();

        return view('peminjaman.edit', compact('peminjaman', 'peminjam', 'asets'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
