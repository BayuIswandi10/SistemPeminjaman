<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSesiRequest extends FormRequest
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
            'sesi_id' => [
                Rule::unique('sesis')->ignore($this->route('sesi')),
            ],
            'nama_sesi'=>['required','max:100'],
            'sesi_awal'=>['required'],
            'sesi_akhir'=>['required'],
        ];
    }
}
