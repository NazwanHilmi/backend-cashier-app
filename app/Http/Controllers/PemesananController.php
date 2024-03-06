<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemesananRequest;
use App\Http\Resources\PemesananCollection;
use App\Http\Resources\PemesananResource;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PemesananController extends Controller {
	public function index(Request $request) {

		$pemesanan = Pemesanan::all();

		$data = new PemesananCollection($pemesanan);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
	}

	public function store(PemesananRequest $request) {

		$validated = $request->validated();

		$pemesanan = Pemesanan::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil ditambahkan',
		]);
	}

	public function show(Request $request, Pemesanan $pemesanan): PemesananResource {

		return new PemesananResource($pemesanan);
	}

	public function update(PemesananUpdateRequest $request, Pemesanan $pemesanan) {

		$validated = $request->validated();

		$pemesanan->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil diupdate',
		]);
	}

	public function destroy(Request $request, Pemesanan $pemesanan) {

		$pemesanan->delete();

		return response()->json([
			'success' => true,
			'message' => 'Pemesanan berhasil dihapus',
		]);
	}
}
