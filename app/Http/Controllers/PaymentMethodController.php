<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Http\Resources\PaymentMethodCollection;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $method = PaymentMethod::all();

		$data = new PaymentMethodCollection($method);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(PaymentMethodRequest $request)
    {
        try {
			$validated = $request->validated();

			if ($request->hasFile('icon')) {
				$validated['icon'] = $request->file('icon')->store('public');
			}

			PaymentMethod::create($validated);

			return response()->json([
				'success' => true,
				'message' => 'Payment type added succesfully',
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'Server Error',
				'error' => $e->getMessage(),
			], 500);
		}
    }
}
