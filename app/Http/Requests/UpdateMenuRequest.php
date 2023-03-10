<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:255',
            'price' => 'required|numeric|max:99999999999',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
            'delete_img' => 'nullable'
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
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama maksimal 255 karakter',
            'desc.string' => 'Deskripsi harus berupa teks',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'category_id.required' => 'Kategori harus diisi',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'img.image' => 'Gambar harus berupa gambar',
            'img.mimes' => 'Gambar harus berupa file dengan ekstensi jpeg, png, jpg, gif, svg, webp',
            'img.max' => 'Gambar maksimal 5 MB',
            'desc.max' => 'Deskripsi maksimal 255 karakter',
            'price.max' => 'Harga maksimal 11 karakter'
        ];
    }
}
