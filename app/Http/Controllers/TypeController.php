<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Type::get();
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
    public function store(TypeRequest $request)
    {
        try {
            $data = Type::create($request->all());
            return response()->json(['status'=>true, 'message' => 'success', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal menampilkan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        try {
            $data = $type->update($request->all());
            return response()->json(['status'=>true, 'message' => 'Update Data berhasil', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal update data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        try {
            $data = $type->delete();
            return response()->json(['status'=>true, 'message' => 'data has been delete', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal delete data']);
        }
    }
}
