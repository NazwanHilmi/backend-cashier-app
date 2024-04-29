<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index() {
        
    }

    public function income()
    {
        $transaksi = Transaksi::get();
    
        $total_income = $transaksi->sum('total_harga');
    
        return response()->json([
            'income' => $total_income,
        ]);
    }

    public function countMenu() {
       $soldMenu = Transaksi::count();

       return response()->json([
        'sold_menu' => $soldMenu,
       ]);
    }

    public function countMenuMonth() {
        $thisMonth = Carbon::now()->format('Y-m');
        $totalSoldMenu = Transaksi::where('tanggal', 'like', $thisMonth . '%')->sum('total_menu');
 
        return response()->json([
         'total' => $totalSoldMenu,
        ]);
     }

    public function totalMenu() {
        $menus = Menu::count();

        return response()->json([
            'total_menu' => $menus,
        ]);
    }

    public function bestMenu() {
        $menuSeller = DetailTransaksi::select('menu_id', DB::raw('count(*) as sold_menu'))->groupBy('menu_id')->orderByDesc('sold_menu')->take(5)->get();

        return response()->json([
            'best_seller' => $menuSeller
        ]);
    }
}
