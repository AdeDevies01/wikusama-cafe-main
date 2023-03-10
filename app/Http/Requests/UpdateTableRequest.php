<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
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
            'number' => 'required|numeric|max:99999999999',
            'capacity' => 'required|numeric|max:99999999999',
            'desc' => 'nullable|string|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages()
    {
        return [
            'number.required' => 'Nomor meja harus diisi',
            'number.numeric' => 'Nomor meja harus berupa angka',
            'number.max' => 'Nomor meja maksimal 11 karakter',
            'capacity.required' => 'Kapasitas harus diisi',
            'capacity.numeric' => 'Kapasitas harus berupa angka',
            'capacity.max' => 'Kapasitas maksimal 11 karakter',
            'desc.string' => 'Deskripsi harus berupa teks',
            'desc.max' => 'Deskripsi maksimal 255 karakter'
        ];
    }
}
