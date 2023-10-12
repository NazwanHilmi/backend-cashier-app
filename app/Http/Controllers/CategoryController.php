<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Category::get();
            return response()->json(['status'=>true, 'message' => 'success', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal menampilkan data']);
        }
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
    public function store(CategoryRequest $request)
    {
        try {
            $data = Category::create($request->all());
            return response()->json(['status'=>true, 'message' => 'success', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal menampilkan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

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
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $category->update($request->all());
            return response()->json(['status'=>true, 'message' => 'Update Data berhasil', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal update data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $data = $category->delete();
            return response()->json(['status'=>true, 'message' => 'data has been delete', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal delete data']);
        }
    }
}
