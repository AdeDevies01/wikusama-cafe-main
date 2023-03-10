<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8',
            'confirmed_password' => 'required|same:password',
            'role' => 'required|in:administrator,manager,cashier',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'username.max' => 'Username maksimal 255 karakter',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Kata sandi harus diisi',
            'password.min' => 'Kata sandi minimal 8 karakter',
            'confirmed_password.required' => 'Konfirmasi kata sandi harus diisi',
            'confirmed_password.same' => 'Konfirmasi kata sandi tidak cocok',
            'role.required' => 'Peran harus diisi',
            'role.in' => 'Peran tidak valid',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berupa gambar dengan format jpg, jpeg, png, webp',
            'photo.max' => 'Foto maksimal 5 MB'
        ];
    }
}
