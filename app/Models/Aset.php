<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    
    protected $table = 'asets';
    protected $primaryKey = 'id_aset';
    protected $fillable = [
        'jenis_barang',
        'kode_barang',
        'identitas_barang',
        'pengguna_barang',
        'tahun_perolehan',
        'nilai_perolehan',
        'nilai_saat_ini',
        'keterangan',
        'qr_code'
    ];

    public function peminjamans(){
        return $this->hasMany(Peminjaman::class, 'id_aset', 'id_aset');
    }
}