<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\KaryawanRequest;
use App\Http\Resources\KaryawanCollection;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = Karyawan::all();

		$data = new KaryawanCollection($karyawan);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(KaryawanRequest $request)
    {
		$validated = $request->validated();

		$karyawan = Karyawan::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Employee succesfully added',
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return new KaryawanResource($karyawan);
    }

    public function update(KaryawanRequest $request, Karyawan $karyawan)
    {
		$validated = $request->validated();

		$karyawan->update($validated);

		$updated_karyawan = new CategoryResource($karyawan);

		return response()->json([
			'success' => true,
			'message' => 'Employee succesfully added',
			'data' => $updated_karyawan,
		]);
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

		return response()->json([
			'success' => true,
			'message' => 'Employee succesfully added',
		]);
    }
}
