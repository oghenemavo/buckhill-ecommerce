<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
            'sort_by' => 'nullable|string',
            'desc' => 'nullable|in:true,false',
            'date_range_from' => 'nullable|date',
            'date_range_to' => 'nullable|date',
            'fix_range' => 'nullable|string|in:today,monthly,yearly',
        ];
    }
}
