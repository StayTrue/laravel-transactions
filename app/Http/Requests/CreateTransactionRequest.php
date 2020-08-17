<?php

namespace App\Http\Requests;

use App\Rules\CurrentTransactionDate;
use App\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTransactionRequest extends FormRequest
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
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'date'    => [
                'required',
                'date_format:Y-m-d H:i:s',
                new CurrentTransactionDate(),
            ],
            'amount'   => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999',
            ],
            'type'     => [
                'required',
                'string',
                Rule::in(Transaction::AVAILABLE_TYPES),
            ]
        ];
    }
}
