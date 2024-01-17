<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'no_pengajuan',
        'nim_peminjaman',
        'nama_peminjam',
        'tanggal_pinjam',
        'sesi_id',
        'keperluan',
        'foto_sebelum',
        'waktu_kembali',
        'foto_setelah',
        'status',
    ];

    public function sesi(){
        return $this->belongsTo(Sesi::class);
    }

    public function barang(){
        return $this->belongsToMany(PeminjamanBarang::class);
    }
}
