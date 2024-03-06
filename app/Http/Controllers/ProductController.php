<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $product = Product::all();

            $data = new ProductCollection($product);

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $validated = $request->validated();

            DB::beginTransaction();
            Product::create($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Produk Titipan berhasil ditambahkan',
            ]);

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Erro',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function show(Request $request, Product $product) : ProductResource
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $validated = $request->validated();

            DB::beginTransaction();

            $product->update( $validated );

            DB::commit();

            return response()->json( [
                'success' => true,
                'message' => 'Produk titipan berhasil diperbarui'
            ] );

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }

    }

    public function destroy(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();

            return response()->json( [
                'success' => true,
                'message' => 'Produk titipan berhasil dihapus'
            ] );

        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function exportPdf() {
        try {

            $data = Product::all();

            $pdf = Pdf::loadView( 'pdf.export', compact( 'data' ) );
            return $pdf->download('Produk.pdf');

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }

    }

    public function importExcel( Request $request ) {
        try {
            $validated = $request->validated();

            Excel::import( new ProductImport, $validated[ 'file' ] );

            return response()->json( [
                'message' => 'Data berhasil diimport'
            ] );

        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }

}
