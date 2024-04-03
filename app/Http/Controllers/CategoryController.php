<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $category = Category::all();

		$data = new CategoryCollection($category);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(CategoryRequest $request)
    {
		$validated = $request->validated();

		$category = Category::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil ditambahkan',
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,Category $category) {

		$validated = $request->validated();

		$category->update($validated);

		$updated_category = new CategoryResource($category);

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil diupdate',
			'data' => $updated_category,
		]);
	}

    public function destroy(Category $category)
    {
        $category->delete();

		return response()->json([
			'success' => true,
			'message' => 'Kategori berhasil dihapus',
		]);
	}

    public function exportPdf() {
        try {

            $data = Category::all();

            $pdf = Pdf::loadView( 'pdf.category', compact( 'data' ) );
            return $pdf->download('Category.pdf');


        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }
}
