<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		$menu = Menu::all();



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

    public function edit(Menu $menu)
    {
        //
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
}
