<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Http\Requests\MejaRequest;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Meja::get();
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
    public function store(MejaRequest $request)
    {
        try {
            $data = Meja::create($request->all());
            return response()->json(['status'=>true, 'message' => 'success', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal menampilkan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meja $meja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MejaRequest $request, Meja $meja)
    {
        try {
            $data = $meja->update($request->all());
            return response()->json(['status'=>true, 'message' => 'Update Data berhasil', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal update data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        try {
            $data = $meja->delete();
            return response()->json(['status'=>true, 'message' => 'data has been delete', 'data' => $data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=> false, 'message' => 'Gagal delete data']);
        }
    }
}
