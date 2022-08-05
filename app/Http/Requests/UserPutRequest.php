<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPutRequest extends FormRequest
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
        $rule = ['required', 'string', 'email', 'max:255'];
        if ($uuid = request()->uuid) {
            $rule[] = Rule::unique('users')->ignore($uuid, 'uuid');
        } else {
            $rule[] = Rule::unique('users')->ignore(auth()->user()->id);
        }

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => $rule,
        ];
    }
}
