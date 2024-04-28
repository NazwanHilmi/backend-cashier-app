<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Http\Requests\MejaRequest;
use App\Http\Resources\MejaCollection;
use App\Http\Resources\MejaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		$search = $request->get('search', '');

		$meja = Meja::all();

		$data = new MejaCollection($meja);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(MejaRequest $request)
    {

		$validated = $request->validated();

		$meja = Meja::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil ditambahkan',
		]);
    }

	public function show(Request $request, Meja $meja): MejaResource {

		return new MejaResource($meja);
	}

    public function update(MejaRequest $request, Meja $meja)
    {
		$validated = $request->validated();

		$meja->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil diupdate',
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Meja $meja)
    {
		$meja->delete();

		return response()->json([
			'success' => true,
			'message' => 'Meja berhasil dihapus',
		]);
    }
}
