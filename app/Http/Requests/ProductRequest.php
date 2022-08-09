<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_uuid' => 'required|uuid|exists:categories,uuid',
            'title' => 'required|string|min:3|max:255',
            'price' => 'required|string|numeric|min:0.1',
            'description' => 'required|string|min:5',
            'metadata' => 'required|array',
            'metadata.brand' => 'required|uuid|exists:brands,uuid',
            'metadata.image' => 'required|uuid|exists:files,uuid',
        ];
    }
}
