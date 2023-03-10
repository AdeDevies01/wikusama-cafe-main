<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'total_price' => 'required|numeric',
            'total_payment' => 'required|numeric|gte:total_price',
            'update_table_status' => 'boolean',
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
            'total_price.required' => 'Total harga harus diisi',
            'total_price.numeric' => 'Total harga harus berupa angka',
            'total_payment.required' => 'Jumlah yang dibayar harus diisi',
            'total_payment.numeric' => 'Jumlah yang dibayar harus berupa angka',
            'total_payment.gte' => 'Jumlah yang dibayar harus lebih besar atau sama dengan total harga',
        ];
    }
}
