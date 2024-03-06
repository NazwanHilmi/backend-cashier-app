<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

	public function login(Request $request) {
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

			if (!Auth::attempt($credentials)) {
				return response()->json([
					'success' => false,
					'message' => 'Email atau password salah.',
				], 404);
			}

			$user = Auth::user();

			$token = $user->createToken('auth-token')->accessToken;

			return response()->json([
				'success' => true,
				'token' => $token,
				'user' => $user,
			]);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}

	}

	public function logout(Request $request) {
		try {
			if (Auth::guard('api')->check()) {
				$accessToken = Auth::guard('api')->user()->token();
				DB::table('oauth_refresh_tokens')
					->where('access_token_id', $accessToken->id)
					->update(['revoked' => true]);

				$accessToken->revoke();

				return response()->json([
					'success' => true,
					'user' => null,
					'message' => 'Logout berhasil',
				]);
			}

			return response()->json([
				'success' => false,
				'user' => null,
				'message' => 'Unauthorized',
			], 401);
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}

	public function profile(Request $request) {
		if (Auth::guard('api')->check()) {
			$user = Auth::guard('api')->user();

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
