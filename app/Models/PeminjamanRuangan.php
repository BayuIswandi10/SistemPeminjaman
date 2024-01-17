<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'ruangan_id',
        'no_pengajuan',
        'nim_peminjaman',
        'nama_peminjam',
        'tanggal_pinjam',
        'sesi_id',
        'jumlah_pengguna',
        'keperluan',
        'pengguna_id',
        'foto_sebelum',
        'waktu_kembali',
        'foto_setelah',
        'status',
    ];

    public function sesi(){
        return $this->belongsTo(Sesi::class);
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class);
    }

    public function pengguna(){
        return $this->belongsTo(Pengguna::class);
    }
}
