<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Http\Controllers\Controller;
use App\Http\Requests\StokRequest;
use App\Http\Resources\StokCollection;
use App\Http\Resources\StokResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;;

class StokController extends Controller
{
    public function index(Request $request)
    {
		$stok = Stok::all();

		$data = new StokCollection($stok);

		return response()->json([
			'success' => true,
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
    public function store(StokRequest $request)
    {
        $validated = $request->validated();

		$stok = Stok::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Stok succesfully added',
		]);
    }

    public function show(Request $request, Stok $stok): StokResource
    {
        return new StokResource($stok);
    }

    public function update(StokRequest $request, Stok $stok)
    {
        $validated = $request->validated();

		$stok->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Stok succesfully update',
		]);
    }

    public function destroy(Request $request, Stok $stok)
    {
        $stok->delete();

		return response()->json([
			'success' => true,
			'message' => 'Stok succesfully delete',
		]);
    }

    public function exportPdf() {
        try {

            $data = Stok::all();

            $pdf = Pdf::loadView( 'pdf.stok', compact( 'data' ) );
            return $pdf->download('Stok.pdf');


        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }
}
