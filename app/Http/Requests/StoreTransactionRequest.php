<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'orderedMenus' => 'required|json',
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'nullable|string|max:100',
            'note' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'orderedMenus.required' => 'Pesanan tidak boleh kosong',
            'orderedMenus.array' => 'Pesanan tidak boleh kosong',
            'table_id.required' => 'Meja tidak boleh kosong',
            'table_id.exists' => 'Meja tidak ditemukan',
            'customer_name.string' => 'Nama pelanggan harus berupa teks',
            'customer_name.max' => 'Nama pelanggan maksimal 100 karakter',
            'note.string' => 'Catatan harus berupa teks',
            'note.max' => 'Catatan maksimal 500 karakter',
        ];
    }
}
