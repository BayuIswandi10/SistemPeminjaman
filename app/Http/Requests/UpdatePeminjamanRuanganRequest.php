<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeminjamanRuanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'peminjaman_ruangan_id' => [
                Rule::unique('peminjaman_ruangans')->ignore($this->route('riwayat_peminjaman_ruangan')),
            ],
            'ruangan_id' => ['required'],
            'no_pengajuan', // Perlu ditambahkan aturan validasi
            'nim_peminjaman',
            'nama_peminjam' ,
            'tanggal_pinjam',
            'sesi_id' => ['required'],
            'jumlah_pengguna' => ['required'],
            'waktu_kembali' => ['required'],
            'keperluan' => ['required'],
            'pengguna_id', 
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
