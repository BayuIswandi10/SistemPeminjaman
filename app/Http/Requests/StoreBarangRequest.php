<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
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
            'nama_barang'=>['required','max:100'],
            'nomor_aktiva'=>['required'],
            'tipe_barang'=>['required'],
            'stok'=>['required'],
            'satuan_barang'=>['required'],
            'keterangan_barang'=>['required'],
            'lokasi_barang'=>['required'],
            'baris_lokasi'=>['required'],
            'status'=>['required'],
        ];
    }
}
