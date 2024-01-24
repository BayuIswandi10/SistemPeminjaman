<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaRequest extends FormRequest
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
            'nama'=>['required','max:100'],
            'alamat'=>['required'],
            'nohp'=>['required'],
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role'=>['required'],
            'main_job'=>['required'],
            'other_job'=>['required'],
            'status'=>['required'],
            'username'=>['required'],
            'password'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus berupa file dengan tipe: :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kilobita.',
        ];
    }
}
