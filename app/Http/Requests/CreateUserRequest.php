<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'currency' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]{3}$/i',
                Rule::in(User::AVAILABLE_CURRENCIES),
            ],
            'nickname' => [
                'required',
                'string',
                'min:4',
                'max:30',
                'unique:users',
            ],
        ];
    }
}
