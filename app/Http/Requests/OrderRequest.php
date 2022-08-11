<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            // 'user_id' => 'required|exists:users',
            'order_status_id' => 'required|exists:order_statuses,id',
            'payment_id' => 'required',
            // 'amount' => 'required|numeric|min:0.1',
            'products' => 'required|array',
            'products.*.product' => 'required|uuid|exists:products,uuid',
            'products.*.quantity' => 'required|integer',
            'address' => 'required|array',
            'address.billing' => 'required|string|min:4',
            'address.shipping' => 'required|string|min:4',
            // 'delivery_fee' => 'required|numeric|min:0.1',
            // 'shipped_at' => 'required|numeric|min:0.1',
        ];
    }
}
