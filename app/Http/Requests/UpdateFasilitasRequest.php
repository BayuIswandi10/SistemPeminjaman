<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFasilitasRequest extends FormRequest
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
            'fasilitas_id' => [
                Rule::unique('fasilitas')->ignore($this->route('fasilitas')),
            ],
            'nama_fasilitas'=>['required','max:100'],
            'foto_fasilitas' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status'=>['required'],
        ];
    }
}
