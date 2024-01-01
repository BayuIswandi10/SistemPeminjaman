<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $primaryKey = 'fasilitas_id';
    protected $table = 'fasilitas';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama_fasilitas',
        'foto_fasilitas',
        'created_by',
        'created_date',
    ];

    public function pengguna(){
        return $this->belongsTo(Pengguna::class,'created_by');
    }

    public function ruangan(){
        return $this->belongsToMany(Ruangan::class);
    }
}
