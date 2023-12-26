<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama_barang',
        'nomor_aktiva',
        'tipe_barang',
        'stok',
        'satuan_barang',
        'keterangan_barang',
        'lokasi_barang',
        'baris_lokasi',
        'gambar_barang',
        'pengguna_id',
        'created_date',
        'status',
    ];

    public function pengguna(){
        return $this->belongsTo(Pengguna::class);
    }

    public function peminjaman_barang(){
        return $this->belongsToMany(PeminjamanBarang::class);
    }
}
