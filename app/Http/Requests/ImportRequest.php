<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImportRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'file' => [ 'required', 'file', 'mimes:xlsx' ]
        ];
    }

    public function messages(): array {
        return [
            'file.required' => 'Berkas wajib diunggah.',
            'file.file' => 'File yang diunggah harus berupa berkas.',
            'file.mimes' => 'File harus berformat XLSX.',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'message' => 'Validasi gagal',
            'error' => $validator->errors(),
        ], 422));
    }
}