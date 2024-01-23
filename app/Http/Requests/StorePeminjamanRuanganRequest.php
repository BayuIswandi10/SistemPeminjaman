<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeminjamanRuanganRequest extends FormRequest
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
            'ruangan_id' => ['required'],
            'no_pengajuan',
            'nim_peminjaman' => ['required'],
            'nama_peminjam' => ['required'],
            'tanggal_pinjam' => [
                'required',
                'date',
                Rule::unique('peminjaman_ruangans')->where(function ($query) {
                    return $query
                        ->where('tanggal_pinjam', $this->tanggal_pinjam)
                        ->where('sesi_id', $this->sesi_id)
                        ->where('ruangan_id', $this->ruangan_id);
                })
            ],            
            'sesi_id' => [
                'required',
                Rule::unique('peminjaman_ruangans')->where(function ($query) {
                    return $query
                        ->where('tanggal_pinjam', $this->tanggal_pinjam)
                        ->where('sesi_id', $this->sesi_id)
                        ->where('ruangan_id', $this->ruangan_id);
                })
            ],
            'jumlah_pengguna' => [
                'required',
                function ($attribute, $value, $fail) {
                    $ruangan = \App\Models\Ruangan::find($this->ruangan_id);

                    if ($ruangan && $value > $ruangan->kapasitas_ruangan) {
                        $fail('Kapasitas ruangan tidak mencukupi');
                    }
                },
            ], 
            'waktu_kembali',
            'keperluan' => ['required'],
            'pengguna_id', 
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
    
}
