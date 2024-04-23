<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Http\Requests\AbsensiRequest;
use App\Http\Resources\AbsensiCollection;
use App\Http\Resources\AbsensiResource;
use App\Imports\AbsensiImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $absensi = Absensi::all();

		$data = new AbsensiCollection($absensi);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(AbsensiRequest $request)
    {
        $validated = $request->validated();

		$absensi = Absensi::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Absensi berhasil ditambahkan',
		]);
    }

    public function show(Absensi $absensi)
    {
        return new AbsensiResource($absensi);
    }

    public function update(AbsensiRequest $request, Absensi $absensi)
    {
        $validated = $request->validated();

		$absensi->update($validated);

		$updated_absensi = new AbsensiResource($absensi);

		return response()->json([
			'success' => true,
			'message' => 'Absensi berhasil diupdate',
			'data' => $updated_absensi,
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

		return response()->json([
			'success' => true,
			'message' => 'Absensi berhasil dihapus',
		]);
    }

    public function exportPdf() {
        try {

            $data = Absensi::all();

            $pdf = Pdf::loadView( 'pdf.absensi', compact( 'data' ) );
            return $pdf->download('Absensi.pdf');


        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => 'Error',
                'error' => $e->getMessage()
            ] );
        }
    }

    public function exportExcel()
    {
        return Excel::download(new AbsensiExport, 'absensiExcel.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        $file = $request->file('file');
    
        Excel::import(new AbsensiImport, $file);
    
        return response()->json(['message' => 'Import data berhasil'], 200);
    }
}
