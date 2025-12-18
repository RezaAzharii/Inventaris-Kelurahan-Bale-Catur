<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use App\Exports\AsetExport;
use Maatwebsite\Excel\Facades\Excel;

class AsetController extends Controller
{
    public function export()
    {
        return Excel::download(
            new AsetExport,
            'data-aset.xlsx'
        );
    }
    
    public function index(Request $request)
    {
        $query = Aset::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('jenis_barang', 'like', "%{$search}%")
                    ->orWhere('identitas_barang', 'like', "%{$search}%")
                    ->orWhere('pengguna_barang', 'like', "%{$search}%");
                });
        }
        $asets = $query->paginate(10);
        $asets->appends(['search' => $request->search]);

        return view('aset.index', compact('asets'));
    }

    public function showPublic( $id)
    {
        $aset = Aset::findOrFail($id);
        return view('aset.show_public', compact('aset'));
    }

    public function create()
    {
        return view('aset.create');
    }

    public function store(Request $request)
    {
        Aset::create($request->only([
            'jenis_barang',
            'kode_barang',
            'identitas_barang',
            'pengguna_barang',
            'tahun_perolehan',
            'nilai_perolehan',
            'nilai_saat_ini',
            'jumlah',
            'keterangan',
        ]));
        return redirect()->route('aset.index')->with('success', 'Data aset berhasil ditambahkan.');
    }

    public function show($id)
    {
        $aset = Aset::findOrFail($id);
        return view('aset.show', compact('aset'));
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);
        $aset->update($request->all());
        return redirect()->route('aset.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();
        return redirect()->route('aset.index')->with('success', 'Data berhasil dihapus.');
    }
}