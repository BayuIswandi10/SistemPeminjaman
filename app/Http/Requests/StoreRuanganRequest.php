<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRuanganRequest extends FormRequest
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
            'nama_ruangan'=>['required','max:100'],
            'lokasi_ruangan'=>['required'],
            'kapasitas_ruangan'=>['required'],
            'fasilitas_ids.*' => 'required|exists:fasilitas,fasilitas_id',
            'jumlah.*' => 'required|integer|min:1',
            'keterangan_ruangan' => ['required'],
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto4' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'koor_upt'=>['required'],
            'pic_lab'=>['required'],
            'admin_lab1'=>['required'],
            'admin_lab2'=>['required'],
            'status' => ['required'],
        ];
    }
}