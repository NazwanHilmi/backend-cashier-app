<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Resources\TypeCollection;
use App\Http\Resources\TypeResource;
use App\Http\Requests\TypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;;

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

    public function store(TypeRequest $request)
    {
        $validated = $request->validated();

		$type = Type::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Jenis berhasil ditambahkan',
		]);
    }

    public function show(Request $request, Type $type): TypeResource {

		return new TypeResource($type);
	}

    public function edit(Type $type)
    {
        //
    }

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

    public function exportPdf() {
        try {

            $data = Type::all();

            $pdf = Pdf::loadView( 'pdf.type', compact( 'data' ) );
            return $pdf->download('Type.pdf');


        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }
}
