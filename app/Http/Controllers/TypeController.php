<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Resources\TypeCollection;
use App\Http\Resources\TypeResource;
use App\Http\Requests\TypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $type = Type::all();

		$data = new TypeCollection($type);
		return response()->json([
			'success' => 'true',
			'data' => $data,
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $validated = $request->validated();

		$type = Type::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil ditambahkan',
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Type $type): TypeResource {

		return new TypeResource($type);
	}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
		$validated = $request->validated();

		$type->update($validated);

		$updatedType = new TypeResource($type);

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil diupdate',
			'data' => $updatedType,
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil dihapus',
		]);
    }
}
