<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeminjamanBarangRequest extends FormRequest
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
            'barang_ids.*' => [
                'required',
                'exists:barangs,barang_id',
                Rule::unique('barang_peminjaman_barang', 'barang_id')
                    ->where(function ($query) {
                        $query->whereIn('peminjaman_barang_id', function ($subquery) {
                            $subquery->from('peminjaman_barangs')
                                ->select('peminjaman_barang_id')
                                ->where('tanggal_pinjam', $this->input('tanggal_pinjam'))
                                ->where('sesi_id', $this->input('sesi_id'));
                        });
                    })
            ],
            'jumlah.*' => 'required|integer|min:1',
            'no_pengajuan', // Tambahkan aturan validasi sesuai kebutuhan
            'nim_peminjaman' => ['required'],
            'nama_peminjam' => ['required'],
            'tanggal_pinjam' => [
                'required',
                'date',
                Rule::unique('peminjaman_barangs')->where(function ($query) {
                    return $query->where('tanggal_pinjam', $this->input('tanggal_pinjam'))
                        ->where('sesi_id', $this->input('sesi_id'));
                }),
            ],
            'sesi_id' => ['required'],
            'waktu_kembali',
            'keperluan' => ['required'],
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'barang_ids.*.unique' => 'Barang yang dipilih sudah dipinjam untuk tanggal dan sesi yang sama.',
        ];
    }
}
