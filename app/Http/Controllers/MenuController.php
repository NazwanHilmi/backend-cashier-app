<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Maatwebsite\Excel\Facades\Excel;;
use App\Exports\MenuExport;
use App\Imports\MenuImport;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		$menu = Menu::all();

		$data = new MenuCollection($menu);

		return response()->json([
			'success' => true,
			'data' => $data,
		]);
    }

    public function store(MenuRequest $request)
    {
		try {
			$validated = $request->validated();
			if ($request->hasFile('image')) {
				$validated['image'] = $request->file('image')->store('public');
			}

			$menu = Menu::create($validated);

			return response()->json([
				'success' => true,
				'message' => 'Menu succesfully added',
			]);
		} catch (Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
			]);

            DB::rollBack();
		}
    }

    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();
		if ($request->hasFile('image')) {
			if ($menu->image) {
				Storage::delete($menu->image);
			}

			$validated['image'] = $request->file('image')->store('public');
		}

		$menu->update($validated);

		$data = new MenuResource($menu);

		return response()->json([
			'success' => true,
			'message' => 'Menu succesfully update',
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Menu $menu)
    {
		if ($menu->image) {
			Storage::delete($menu->image);
		}

		$menu->delete();

		return response()->json([
			'success' => true,
			'message' => 'Menu succesfully delete',
		]);
	}

    public function exportPdf() {
        try {

            $data = Menu::all();

            $pdf = Pdf::loadView( 'pdf.menu', compact( 'data' ) );
            return $pdf->download('Menu.pdf');


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
        return Excel::download(new MenuExport, 'menuExcel.xlsx');
    }

	public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        $file = $request->file('file');
    
        Excel::import(new MenuImport, $file);
    
        return response()->json(['message' => 'Import data berhasil'], 200);
    }
}
