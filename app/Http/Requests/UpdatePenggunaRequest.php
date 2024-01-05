<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdatePenggunaRequest extends FormRequest
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
            'pengguna_id' => [
                Rule::unique('penggunas')->ignore($this->route('pengguna')),
            ],
            'nama'=>['required','max:100'],
            'alamat'=>['required'],
            'nohp'=>['required'],
            'foto' => '|image|mimes:jpeg,png,jpg|max:2048',
            'main_job'=>['required'],
            'other_job'=>['required'],
            'status',
            'username',
            'password',
        ];
    }
}
