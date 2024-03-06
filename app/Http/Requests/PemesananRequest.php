<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PemesananRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tanggal_pemesanan' => ['required', 'date'],
            'jam_mulai' => ['required', 'date_format:H:i:s'],
            'jam_selesai' => ['required', 'date_format:H:i:s'],
            'nama_pemesan' => ['required', 'max:255', 'string'],
            'jumlah_pelanggan' => ['required', 'numeric'],
            'meja_id' => ['required', 'exists:meja,id'],
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
