<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\PDF;
use Dompdf\Exception;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

		// $search = $request->get('search', '');

		$customers  = Customer::all();

		$data = new CustomerCollection($customers);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }


    public function store(CustomerRequest $request)
    {
        $validated = $request->validated();

		$customer = Customer::create($validated);

		return response()->json([
			'success' => true,
			'message' => 'Customer succesfully added',
		]);
    }

    public function show(Request $request, Customer $customer) : CustomerResource
    {
        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

		$customer->update($validated);

		return response()->json([
			'success' => true,
			'message' => 'Customer succesfully update',
		]);
    }

    public function destroy(Request $request, Customer $customer)
    {
        $customer->delete();

		return response()->json([
			'success' => true,
			'message' => 'Customer succesfully delete',
		]);
    }

    public function exportPdf() {
        try {

            $data = Customer::all();

            $pdf = Pdf::loadView( 'pdf.customer', compact( 'data' ) );
            return $pdf->download('customer.pdf');


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
        return Excel::download(new CustomerExport, 'customerExcel.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new CustomerImport, $file);

        return response()->json(['message' => 'Import data berhasil'], 200);
    }
}
