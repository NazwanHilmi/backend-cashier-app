<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

	public function login(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'email' => ['required', 'email'],
				'password' => ['required'],
			], [
				'email.required' => 'Email tidak boleh kosong',
				'email.email' => 'Email tidak valid',
				'password.required' => 'Password tidak boleh kosong',
			]);

			if ($validator->fails()) {
				return response()->json([
					'success' => false,
					'message' => 'Data tidak valid',
					'error' => $validator->errors(),
				], 422);
			}

			$credentials = $validator->validated();

			$is_user = User::where('email', $credentials['email'])->first();

			if (!$is_user || !Hash::check($credentials['password'], $is_user->password)) {
				return response()->json([
					'message' => 'Email atau password salah'
				]);
			}

			$token = $is_user->createToken('auth-token')->accessToken;

			return response()->json([
				'success' => true,
				'accessToken' => $token,
				'name' => $is_user->name,
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}

	public function logout(Request $request)
	{
		try {
			if (FacadesAuth::guard('api')->check()) {
				$request->user()->token()->revoke();

				return response()->json([
					'message' => 'Logout Berhasil',
				]);
			}
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}

	public function profile(Request $request)
	{
		if (FacadesAuth::guard('api')->check()) {
			$user = FacadesAuth::guard('api')->user();

			return response()->json([
				'success' => true,
				'user' => $user,
			]);
		}
		return response()->json([
			'success' => false,
			'user' => null,
		], 401);
	}
}
