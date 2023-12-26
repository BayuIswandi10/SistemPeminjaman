<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama_fasilitas',
        'foto_fasilitas',
        'pengguna_id',
        'created_date',
    ];

    public function pengguna(){
        return $this->belongsTo(Pengguna::class);
    }

    public function ruangan(){
        return $this->belongsToMany(Ruangan::class);
    }
}
