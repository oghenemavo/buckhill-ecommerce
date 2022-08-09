<?php

namespace App\Http\Requests;

use App\Enums\PaymentType;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $details = [];
        $type = request()->type;
        
        switch (PaymentType::tryFrom($type)) {
            case PaymentType::CREDIT_CARD:
                $details['details.holder_name'] = 'required|string';
                $details['details.number'] = 'required|string';
                $details['details.ccv'] = 'required|digits:3';
                break;

            case PaymentType::CASH_ON_DELIVERY:
                $details['details.expire_date'] = 'required|string';
                $details['details.first_name'] = 'required|string|min:3';
                $details['details.last_name'] = 'required|string|min:3';
                $details['details.address'] = 'required|string|min:3';
                break;
            case PaymentType::BANK_TRANSFER:
                $details['details.swift'] = 'required|string|min:3';
                $details['details.iban'] = 'required|string|min:3';
                $details['details.name'] = 'required|string|min:3';
                break;
        }
        $rules = [
            'type' => 'required|string|min:3|max:255',
            'details' => 'required|array'
        ];

        return array_merge($rules, $details);
    }
}
