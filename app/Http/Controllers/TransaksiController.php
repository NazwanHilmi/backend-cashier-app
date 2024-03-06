<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\TransaksiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiCollection;
use App\Http\Resources\TransaksiResource;
use App\Models\Stok;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{
    public function index(Request $request): TransaksiCollection
    {
        $transaksi = Transaksi::all();

        return new TransaksiCollection($transaksi);
    }

    public function store(TransaksiRequest $request)
    {
            try {

                $validated = $request->validated();
                $validated['tanggal'] = Carbon::now()->format('Ymd');

                // $lastId = Transaksi::where('tanggal', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();
                // $notafaktur = $lastId == null ? Carbon::now()->format('Ymd').'0001' : Carbon::now()->format('Ymd').sprintf('%04d', (int)substr($lastId->id,  8,  4) +  1);

                // $transaksi = Transaksi::create([
                //     'id' => $notafaktur,
                //     'tanggal' => $validated['tanggal'],
                //     'total_harga' => $validated['total_harga'],
                //     'payment_method_id' =>  1,
                //     'note' => ''
                // ]);

                DB::beginTransaction();
                $transaksi = Transaksi::create($validated);

                foreach ($validated['menu'] as $menu) {
                    $stok = Stok::where('menu_id', $menu['menu_id'])->first();
                    $stok->update(['jumlah' => $stok->jumlah - $menu['quantity']]);
                    $data = [
                        'menu_id' => $menu['menu_id'],
                        'quantity' => $menu['quantity'],
                        'sub_total' => $menu['sub_total'],
                        'unit_price' => $menu['unit_price'],
                        'transaksi_id' => $transaksi->id,
                    ];

                    DetailTransaksi::create($data);
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Transaction successfully added',
                    'data' => $transaksi,
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ],  500);
            }
        }

    public function show(Request $request, Transaksi $transaksi)
    {
        return new TransaksiResource($transaksi);
    }


    public function update(TransaksiRequest $request, Transaksi $transaksi)
    {
        $validated = $request->validated();

        $transaksi->update($validated);
        return response()->json([
			'success' => true,
			'message' => 'Transaction succesfully added',
		]);
    }

    public function destroy(Request $request, Transaksi $transaksi)
    {
        $transaksi->delete();

        return response()->json([
			'success' => true,
			'message' => 'Transaction succesfully deletes',
		]);
    }

}
