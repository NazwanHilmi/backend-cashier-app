<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'menu_id' => ['required', 'exists:menus,id'],
			'quantity' => ['required', 'numeric'],
			'sub_total' => ['required', 'numeric'],
			'unit_price' => ['required', 'numeric'],
			'transaction_id' => ['required', 'exists:transactions,id'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
