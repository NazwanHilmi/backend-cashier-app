<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportNotaController extends Controller
{
    public function cetakNota($id) {
        try {
                $data = Transaksi::findOrFail($id);

                $pdf = Pdf::loadView( 'pdf.nota', compact( 'data' ) );
                return $pdf->download('Nota.pdf');


            } catch ( Exception $e ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Error',
                    'error' => $e->getMessage()
                ] );
            }
    }

}
