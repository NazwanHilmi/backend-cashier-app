<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TransaksiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'total_harga' => ['required', 'numeric'],
			'payment_method_id' => ['required', 'exists:payment_methods,id'],
			'note' => ['required', 'string', 'max:1000'],
			'menu' => ['required', 'array'],
        ];
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ]));
    // }
}
