<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailTransaksiRequest;
use App\Http\Resources\DetailTransaksiCollection;
use App\Http\Resources\DetailTransaksiResource;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DetailTransaksiController extends Controller
{
    public function index(Request $request) : DetailTransaksiCollection
    {
        $detailTransaksi = DetailTransaksi::all();

		return new DetailTransaksiCollection($detailTransaksi);
    }

    public function store(DetailTransaksiRequest $request)
    {
        $validated = $request->validated();

		$detailTransaksi = DetailTransaksi::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Transaction detail succesfully added',
		]);
    }

    public function show(Request $request, DetailTransaksi $detailTransaksi) : DetailTransaksiResource
    {
        return new DetailTransaksiResource($detailTransaksi);
    }

    public function update(DetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        $validated = $request->validated();

		$detailTransaksi->update($validated);

		return response()->json([
			'success' => true,
            'message' => 'Transaction detail succesfully update',
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->delete();

		return response()->json([
			'success' => true,
            'message' => 'Transaction detail succesfully delete',
		]);
    }
}
