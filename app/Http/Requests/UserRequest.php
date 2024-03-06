<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
			'address' => ['required', 'max:255', 'string'],
			'email' => ['required', 'unique:users,email', 'email'],
			'phone' => ['required', 'max:255', 'string'],
			'password' => ['required'],
			'role_id' => ['required', 'exists:roles,id'],
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
