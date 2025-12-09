<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_peminjam',
        'id_aset',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'jumlah'
    ];

    public function peminjam(){
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id_peminjam');
    }

    public function Aset(){
        return $this->belongsTo(Aset::class, 'id_aset', 'id_aset');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}