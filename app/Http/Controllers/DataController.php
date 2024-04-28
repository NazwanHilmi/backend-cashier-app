<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaksi;

class DataController extends Controller
{
    public function index() {
        $soldMenu = $this->countMenu();

        return response()->json([
            'sold_menu' => $soldMenu,
        ]);
    }

    public function income()
    {
        $transaksi = Transaksi::get();
    
        $total_income = $transaksi->sum('total_harga');
    
        return response()->json([
            'income' => $total_income,
        ]);
    }

    private function countMenu() {
        $detailTransaksi = DetailTransaksi::all();

        // Menginisialisasi variabel untuk menyimpan jumlah menu terjual
        $countSoldMenu = 0;

        // Menghitung jumlah menu terjual
        foreach ($detailTransaksi as $detail) {
            $countSoldMenu += $detail->quantity;
        }

        return $countSoldMenu;
    }
}
