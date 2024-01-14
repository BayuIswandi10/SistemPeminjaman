<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
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
            'barang_id' => [
                Rule::unique('barangs')->ignore($this->route('barang')),
            ],
            'nama_barang'=>['required','max:100'],
            'nomor_aktiva'=>['required'],
            'tipe_barang'=>['required'],
            'stok'=>['required'],
            'satuan_barang'=>['required'],
            'keterangan_barang'=>['required'],
            'gambar_barang'=>'|image|mimes:jpeg,png,jpg|max:2048',
            'lokasi_barang'=>['required'],
            'baris_lokasi'=>['required'],
            'status'=>['required'],
        ];
    }
}
