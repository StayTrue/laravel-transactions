<?php

namespace App\Http\Requests;

use App\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllTransactionsRequest extends FormRequest
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
            'orderBy'   => [
                'string',
                Rule::in(Transaction::AVAILABLE_ORDER_BY),
            ],
            'sortOrder' => [
                'string',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }
}
